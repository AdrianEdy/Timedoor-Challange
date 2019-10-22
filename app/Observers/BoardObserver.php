<?php

namespace App\Observers;

use App\Models\Board;
use Image;
use Illuminate\Support\Facades\Storage;
use File;
use App\Http\Requests\BoardModalRequest;

class BoardObserver
{
    /**
     * Handle the board "created" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function created(Board $board)
    {
        $thisBoard  = $board->getDirty();
        $imageName  = $thisBoard['image'];
        $request    = request();

        if ($request->image) {
            $request->image->storeAs($board->getImageFolder(), $imageName, 'public');

            $thumbnail = Image::make(Storage::get("public/" 
                       . $board->getImageFolder() . $imageName));

            $path = storage_path('app/public/' . $board->getImageFolder() . 'thumbnail');
            
            if (! File::exists($path)) File::makeDirectory($path, 775, true);

            $thumbnail->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbnail->save($path . '/' . $imageName);
        }
        
    }

    /**
     * Handle the board "updated" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function updated(Board $board)
    {
        $thisBoard  = $board->getDirty();
        $imageName  = $thisBoard['image'];
        $request    = request();

        if ($request->editImage && $imageName) {
            
            $request->editImage->storeAs($board->getImageFolder(), $imageName, 'public');

            $thumbnail = Image::make(Storage::get("public/" . $board->getImageFolder() . $imageName));
            $path      = storage_path("app/public/" . $board->getImageFolder() . "thumbnail");

            if (! File::exists($path)) File::makeDirectory($path, 775, true);

            $thumbnail->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbnail->save($path . '/' . $imageName);
        } 
    }

    /**
     * Handle the board "deleted" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function deleted(Board $board)
    {
        //
    }

    /**
     * Handle the board "restored" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function restored(Board $board)
    {
        //
    }

    /**
     * Handle the board "force deleted" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function forceDeleted(Board $board)
    {
        //
    }
}
