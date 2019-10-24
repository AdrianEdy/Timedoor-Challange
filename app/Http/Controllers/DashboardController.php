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

        return view('admin/content/dashboard', compact('boards'));
    }

    public function destroy(Board $board, $id)
    {
        $findBoard = $board->find($id);
        $findBoard->deleteRecordAndImage();
        
        return back();
    }

    public function destroyImage($id)
    {
        $board = Board::find($id);
        
        // Add true parameter if you want to set image field to null in database
        $board->deleteImage(true);

        return back();
    }

    public function destroyMultiple(Request $request)
    {
        foreach ($request->checked as $check) {
            $board = Board::find($check);
            $board->deleteRecordAndImage();
        }
        
        return back();
    }

    public function restore(Board $board, $id)
    {
        $board->withTrashed()->find($id)->restore();

        return back();
    }
}
