<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Image;
use File;

class Board extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    private $imageFolder = 'image/board/';

    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function getImageFolder()
    {
        return $this->imageFolder;
    }

    public function createRecordAndImage($data = [])
    {
        $this->create($data);
        $this->uploadImage($data['image']);
    }

    public function updateRecordAndImage($data = [])
    {
        $this->update($data);
        $this->deleteImage();
        $this->uploadImage($data['image'], true);
    }

    public function deleteRecordAndImage()
    {
        $this->delete();
        $this->deleteImage(true);
    }

    public function uploadImage($imageName, $edit = false)
    {
        $request = request();
        $image  = 'image';
        
        if ($edit) {
            $image = 'editImage';
        }

        if ($request->$image) {
            $request->$image->storeAs($this->getImageFolder(), $imageName, 'public');

            $thumbnail = Image::make(Storage::get("public/" 
                       . $this->getImageFolder() . $imageName));

            $path = storage_path('app/public/' . $this->getImageFolder() . 'thumbnail');
            
            if (! File::exists($path)) File::makeDirectory($path, 775, true);

            $thumbnail->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbnail->save($path . '/' . $imageName);
        }
    }

    public function deleteImage($deleteData = false)
    {
        $imageName = $this->image;
        Storage::delete("public/" . $this->getImageFolder() . $imageName);
        Storage::delete("public/" . $this->getImageFolder() . "thumbnail/{$imageName}");
        
        if ($deleteData) {
            $this->update([
                'image' => null
            ]);
        }
    }
}
