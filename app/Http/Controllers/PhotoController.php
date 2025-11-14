<?php

namespace App\Http\Controllers;


use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController
{
    public function store($complaint_id, $image) {
        $photo = new Photo();
        $filename = time();
        Storage::put('images/' . $filename .  "." . $image->getClientOriginalExtension(), file_get_contents($image));
        $photo->complaint_id = $complaint_id;
        $photo->file_name = $filename .".". $image->getClientOriginalExtension();
        $photo->file_path = 'images/';
        $photo->mime_type = $image->getMimeType();
        $photo->save();
        return $photo->id;
    }
}
