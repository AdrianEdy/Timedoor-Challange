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
        $board->user_id  = $request->user()->id;
        $board->name     = $request->name;
        $board->title    = $request->title;
        $board->message  = $request->body;
        $board->image    = $request->image ? $request->image->store('image/upload', 'public') : null;
        $board->password = $request->password ? Hash::make($request->password) : null;
        $board->save();
        
        return redirect('/');
    }

    public function edit(Request $request, $id)
    {
        $board   = Board::find($id);
        $message = null;

        if ($request->user()->id ?? null === $id) {
            return response()->json($board);
        }

        $request->validate([
            'password' => 'nullable|numeric|digits:4'
        ]);
        
        if (Hash::check($request->password, $board->password)) {
            return response()->json($board);
        } else {
            if (is_null($board->password)) {
                $message = "This message can't edit, because this message has not been set password";
            } else {
                $message = "The password you entered do not match, Please try again";
            }
        }
        
        return response()->json(['password' => false, 'message' => $message]);
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

        $board = Board::find($id);
        if ($request->has('deleteImage')) {
            Storage::delete("public/{$board->image}");
            Board::where('id', $id)->update([
                'image' => null
            ]);
        } else {
            $image = $request->editImage ?? false;
            Board::where('id', $id)->update([
                'image' => $image ? $image->store('image/upload', 'public') : $board->image
            ]);
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
        $board   = Board::find($id);
        $message = null;
        
        $request->validate([
            'password' => 'nullable|numeric|digits:4'
        ]);

        if ($request->user()->id ?? null === $id) {
            return response()->json($board);
        }
        
        if (Hash::check($request->password, $board->password)) {
            return response()->json();
        } else {
            if (is_null($board->password)) {
                $message = "This message can't delete, because this message has not been set password";
            } else {
                $message = "The password you entered do not match, Please try again";
            }
        }
        
        return response()->json(['password' => false, 'message' => $message]);
    }

    public function destroy($id)
    {
        $board = Board::find($id);
        Storage::delete("public/{$board->image}");
        Board::destroy($id);
        return back();
    }
}
