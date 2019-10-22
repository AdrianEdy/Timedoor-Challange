<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BoardModalRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Board;

class BoardController extends Controller
{
    public function index(Board $board)
    {
        $boards = $board->latest()->paginate(10)->onEachSide(2);

        return view('user/content/home', compact('boards'));
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
        
        return redirect('/');
    }

    public function edit(Request $request, $id)
    {   
        try {
            $board = Board::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->withError("There is no board was found");
        }

        if (! (($request->user()->id ?? false) === $board->user_id)) {
            $check = $this->checkPassword($board->password, $request->submitPass, 'edit');

            if ($check['passErr']) {
                return back()
                    ->with('board', $board)
                    ->with('modal', 'edit')
                    ->with('passErr', $check['passErr'])
                    ->with('message', $check['message']);
            } 
        }

        return back()
            ->with('board', $board)
            ->with('submitPass', $request->submitPass)
            ->with('modal', 'edit');
    }

    public function update(BoardModalRequest $request, $id)
    {
        try {
            $board = Board::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->withError("There is no board was found");
        }

        $check = $this->checkPassword($board->password, $request->submitPass, 'edit');

        if (! (is_null($check['passErr']) || (($request->user()->id ?? false) === $board->user_id))) {
            return back();
        }
        
        $image = null;
        if ($request->has('deleteImage')) {
            Storage::delete("public/" . $board->getImageFolder() . $board->image);
            Storage::delete("public/" . $board->getImageFolder() . "thumbnail/{$board->image}");
        } else {
            $imageName = $request->editImage ? uniqid('img_') . '.' 
                       . $request->editImage->getClientOriginalExtension() : null;
            $image     = $request->editImage ? $imageName : $board->image;

            if ($request->editImage) {
                Storage::delete("public/" . $board->getImageFolder() . $board->image);
                Storage::delete("public/" . $board->getImageFolder() . "thumbnail/{$board->image}");
            }
        }

        $board->update([
            'name'    => $request->editName,
            'title'   => $request->editTitle,
            'message' => $request->editBody,
            'image'   => $image
        ]);

        return back();
    }

    public function delete(Request $request, $id)
    {
        try {
            $board = Board::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->withError("There is no board was found");
        }

        if (! (($request->user()->id ?? false) === $board->user_id)) {
            $check = $this->checkPassword($board->password, $request->submitPass, 'delete');
        
            if ($check['passErr']) {
                return back()
                    ->with('board', $board)
                    ->with('modal', 'delete')
                    ->with('passErr', $check['passErr'])
                    ->with('message', $check['message']);
            } 
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
