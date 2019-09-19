<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Board;

class BoardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'nullable|between:3,16',
            'title'     => 'required|between:10,32',
            'body'      => 'required|between:10,200',
            'image'     => 'image|max:1000',
            'password'  => 'nullable|numeric|digits:4'
        ]);

        $board           =  new Board;
        $board->user_id  = $request->user()->id ?? null;
        $board->name     = $request->name;
        $board->title    = $request->title;
        $board->message  = $request->body;
        $imageName       = $request->image ? 
            uniqid('img_') . '.' . $request->image->getClientOriginalExtension() : null;
        $board->image    = $request->image ? $imageName : null;
        $board->password = $request->password ? Hash::make($request->password) : null;
        $board->save();

        if ($request->image) {
            $request->image->storeAs('image/board', $imageName, 'public');
        }
        
        return redirect('/');
    }

    public function edit(Request $request, $id)
    {
        $board         = Board::find($id, ['id', 'name', 'title', 'message', 'image']);
        $boardPassword = Board::where('id', $id)->value('password');
        $check         = $this->checkPassword($boardPassword, $request->password, 'edit');

        if ($request->user()->id ?? null === $id) {
            return response()->json(['board' => $board]);
        }
        
        $check = $this->checkPassword($boardPassword, $request->password, 'edit');

        $returnData = ['board' => $board, 'passErr' => $check['passErr'], 'message' => $check['message']];
        return response()->json($returnData);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'editName'  => 'nullable|between:3,16',
            'editTitle' => 'required|between:10,32',
            'editBody'  => 'required|between:10,200',
            'editImage' => 'image|max:1000'
        ];

        $messages = [
            'editName.between'   => [
                'string' => 'The name must be between :min and :max characters.'
            ],
            'editTitle.required' => 'The title field is required.',
            'editTitle.between'  => [
                'string' => 'The title must be between :min and :max characters.'
            ],
            'editBody.required'  => 'The body field is required.',
            'editBody.between'   => [
                'string' => 'The body must be between :min and :max characters.'
            ],
            'editImage.image'    => 'The image must be an image.',
            'editImage.max'      => [
                'file' => 'The image may not be greater than :max Kilobytes.'
            ]
        ];

        $request->validate($rules, $messages);

        $board         = Board::find($id, ['id', 'name', 'title', 'message', 'image']);
        $boardPassword = Board::where('id', $id)->value('password');
        $check         = $this->checkPassword($boardPassword, $request->password, 'edit');
        
        if (!is_null($check['passErr'])) {
            return response()->json();
        }
        
        if ($request->has('deleteImage')) {
            Storage::delete("public/image/board/{$board->image}");
            Board::where('id', $id)->update([
                'image' => null
            ]);
        } else {
            $imageName = $request->editImage ? 
                uniqid('img_') . '.' . $request->editImage->getClientOriginalExtension() : null;
            Board::where('id', $id)->update([
                'image' => $request->editImage ? $imageName : $board->image
            ]);
            if ($request->editImage) {
                $request->editImage->storeAs('image/board', $imageName, 'public');
            }
        }

        Board::where('id', $id)->update([
            'name' => $request->editName,
            'title' => $request->editTitle,
            'message' => $request->editBody
        ]);
        return response()->json();
    }

    public function delete(Request $request, $id)
    {
        $board         = Board::find($id, ['id', 'name', 'title', 'message', 'image']);
        $boardPassword = Board::where('id', $id)->value('password');
        $check         = $this->checkPassword($boardPassword, $request->password, 'delete');

        if ($request->user()->id ?? null === $id) {
            return response()->json(['board' => $board]);
        }
        
        $returnData = ['board' => $board, 'passErr' => $check['passErr'], 'message' => $check['message']];
        return response()->json($returnData);
    }

    public function destroy($id)
    {
        $board = Board::find($id);
        Storage::delete("public/image/board/{$board->image}");
        Board::destroy($id);
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
            if (!Hash::check($requestPassword, $boardPassword)) {
                $message = "The password you entered do not match, Please try again";
                $passErr = 'wrong';
            } 
        }
        return ['passErr' => $passErr, 'message' => $message];
    }
}
