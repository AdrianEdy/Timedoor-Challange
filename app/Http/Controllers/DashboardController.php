<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Board $board)
    {
        $boards = $board->withTrashed()->latest()->paginate(20)->onEachSide(2);

        return view('admin/content/dashboard', compact('boards'));
    }

    public function search(Request $request, Board $board)
    {
        $boards= null;

        if ($request->statusOption === 'on') {
            $boards = $board;
        } else if ($request->statusOption === 'delete') {
            $boards = $board->onlyTrashed();
        } else {
            $boards = $board->withTrashed();
        }

        if ($request->imageOption === 'with') {
            $boards = $boards->whereNotNull('image');
        } else if ($request->imageOption === 'without') {
            $boards = $boards->whereNull('image');
        }

        if (! empty($request->title)) {
            $boards = $boards->where('title', 'like', '%' . $request->title . '%');
        }

        if (! empty($request->message)) {
            $boards = $boards->where('message', 'like', '%' . $request->message . '%');
        }

        $boards = $boards->latest()->paginate(20)->onEachSide(2);

        return view('admin/content/dashboard')->with('boards', $boards);
    }

    public function destroy(Board $boards, $id)
    {
        $board = $boards->find($id);
        Storage::delete("public/image/board/{$board->image}");
        Storage::delete("public/image/board/thumbnail/{$board->image}");
        $board->delete();
        
        return back();
    }

    public function destroyImage($id)
    {
        $board = Board::find($id);
        Storage::delete("public/image/board/{$board->image}");
        Storage::delete("public/image/board/thumbnail/{$board->image}");
        $board->update([
            'image' => null
        ]);

        return back();
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->checked as $check) {
            $board = Board::find($check);
            Storage::delete("public/image/board/{$board->image}");
            Storage::delete("public/image/board/thumbnail/{$board->image}");
            $board->update([
                'image' => null
            ]);
            $board->delete();
        }
        
        return back();
    }

    public function restore(Board $board, $id)
    {
        $board->withTrashed()->find($id)->restore();

        return back();
    }
}
