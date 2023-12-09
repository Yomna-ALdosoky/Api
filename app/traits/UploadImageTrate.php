<?php
namespace App\traits;
use Illuminate\Http\Request;

trait UploadImageTrate
{
    public function uploadImage(Request $request, $folderName){
        $image = $request->file('photo')->getClientOriginalName();
        $path  = $request->file('photo')->storeAs($folderName,  $image,'yomna');

        return $path;

    }
}