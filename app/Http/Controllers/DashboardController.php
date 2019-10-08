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

        return view('content/dashboard')->with('boards', $boards);
    }

    public function search(Board $board)
    {
        $boards = $board->withTrashed()->latest()->paginate(20)->onEachSide(2);

        return view('content/dashboard')->with('boards', $boards);
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
        Board::whereIn('id', $request->checked)->delete();
        return back();
    }

    public function restore(Board $board, $id)
    {
        $board->withTrashed()->find($id)->restore();

        return back();
    }
}
