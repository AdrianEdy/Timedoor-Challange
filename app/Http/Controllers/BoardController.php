<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BoardModalRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Board;
use Image;
use File;

class BoardController extends Controller
{
    public function index(Board $board)
    {
        $boards = $board->latest()->paginate(10)->onEachSide(2);

        return view('user/content/home')->with('boards', $boards);
    }

    public function store(Request $request, Board $board)
    {
        $request->validate([
            'name'      => 'nullable|between:3,16',
            'title'     => 'required|between:10,32',
            'body'      => 'required|between:10,200',
            'image'     => 'image|max:1000',
            'password'  => 'nullable|numeric|digits:4'
        ]);

        $imageName       = $request->image ? uniqid('img_') . '.' 
                         . $request->image->getClientOriginalExtension() : null;

        $board->create([
            'user_id'  => $request->user()->id ?? null,
            'name'     => $request->name,
            'title'    => $request->title,
            'message'  => $request->body,
            'image'    => $imageName,
            'password' => $request->password ? Hash::make($request->password) : null
        ]);

        if ($request->image) {
            $request->image->storeAs($board->getImageFolder(), $imageName, 'public');

            $thumbnail = Image::make(Storage::get("public/" 
                       . $board->getImageFolder() . $imageName));

            $path = storage_path('app/public/image/board/thumbnail');
            
            if (! File::exists($path)) File::makeDirectory($path, 775, true);

            $thumbnail->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbnail->save($path . '/' . $imageName);
        }
        
        return redirect('/');
    }

    public function edit(Request $request, $id)
    {   
        try {
            $board         = Board::findOrFail($id, 
                            ['id', 'user_id', 'name', 'title', 'message', 'image']);
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }

        $boardPassword = Board::where('id', $id)->value('password');

        $check         = $this->checkPassword($boardPassword, 
                         $request->submitPass, 'edit');

        if (($request->user()->id ?? false) === $board->user_id) {
            return back()
                ->with('board', $board)
                ->with('submitPass', $request->submitPass)
                ->with('modal', 'edit');
        }
        
        $check = $this->checkPassword($boardPassword, $request->submitPass, 'edit');

        if ($check['passErr']) {
            return back()
                ->with('board', $board)
                ->with('modal', 'edit')
                ->with('passErr', $check['passErr'])
                ->with('message', $check['message']);
        } 

        return back()
            ->with('board', $board)
            ->with('submitPass', $request->submitPass)
            ->with('modal', 'edit');
    }

    public function update(BoardModalRequest $request, $id)
    {
        $board         = Board::find($id, ['id', 'user_id', 'name', 'title', 'message', 'image']);
        $boardPassword = Board::where('id', $id)->value('password');
        $check         = $this->checkPassword($boardPassword, $request->submitPass, 'edit');

        if (! (is_null($check['passErr']) || (($request->user()->id ?? false) === $board->user_id))) {
            return back();
        }
        
        if ($request->has('deleteImage')) {
            Storage::delete("public/image/board/{$board->image}");
            Storage::delete("public/image/board/thumbnail/{$board->image}");
            Board::where('id', $id)->update([
                'image' => null
            ]);
        } else {
            $imageName = $request->editImage ? uniqid('img_') . '.' 
                       . $request->editImage->getClientOriginalExtension() : null;
            Board::where('id', $id)->update([
                'image' => $request->editImage ? $imageName : $board->image
            ]);
            if ($request->editImage) {
                Storage::delete("public/image/board/{$board->image}");
                Storage::delete("public/image/board/thumbnail/{$board->image}");

                $request->editImage->storeAs('image/board', $imageName, 'public');

                $thumbnail = Image::make(Storage::get("public/image/board/{$imageName}"));
                $path      = storage_path('app/public/image/board/thumbnail');

                if (! File::exists($path)) File::makeDirectory($path, 775, true);

                $thumbnail->resize(250,250);
                $thumbnail->save($path . '/' . $imageName);
            }
        }

        Board::where('id', $id)->update([
            'name' => $request->editName,
            'title' => $request->editTitle,
            'message' => $request->editBody
        ]);

        return back();
    }

    public function delete(Request $request, $id)
    {
        $board         = Board::find($id, ['id', 'user_id', 'name', 'title', 'message', 'image']);
        $boardPassword = Board::where('id', $id)->value('password');

        if (($request->user()->id ?? false) === $board->user_id) {
            return back()
                ->with('board', $board)
                ->with('submitPass', $request->submitPass)
                ->with('modal', 'delete');
        }

        $check = $this->checkPassword($boardPassword, $request->submitPass, 'delete');
        
        if ($check['passErr']) {
            return back()
                ->with('board', $board)
                ->with('modal', 'delete')
                ->with('passErr', $check['passErr'])
                ->with('message', $check['message']);
        } 

        return back()
            ->with('board', $board)
            ->with('submitPass', $request->submitPass)
            ->with('modal', 'delete');
    }

    public function destroy(Request $request, $id)
    {
        $board = Board::find($id);
        $check = $this->checkPassword($board->password, $request->submitPass, 'delete');

        if (is_null($check['passErr']) || (($request->user()->id ?? false) === $board->user_id)) {
            Storage::delete("public/image/board/{$board->image}");
            Storage::delete("public/image/board/thumbnail/{$board->image}");
            $board->update([
                'image' => null
            ]);
            $board->delete($id);
        }

        return back();
    }

    private function checkPassword($boardPassword, $requestPassword, $action)
    {
        $passErr = null;
        $message = null;

        if (is_null($boardPassword)) {
            $message = "This message can't " . $action 
                     .", because this message has not been set password";
            $passErr = 'not set';
        } else {
            if (! Hash::check($requestPassword, $boardPassword)) {
                $message = "The password you entered do not match, Please try again";
                $passErr = 'wrong';
            } 
        }
        return ['passErr' => $passErr, 'message' => $message];
    }
}
