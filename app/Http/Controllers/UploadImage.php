<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\traits\UploadImagetrate;
use Illuminate\Http\Request;


class UploadImage extends Controller
{
    use UploadImageTrate;
    public function index(){
        $images= Image::all();
        return view('index', compact('images'));

    }
    public function showform(){
        return view('upload');
    }

    
    public function store(Request $request){
        $path= $this->uploadImage($request, 'users');
        Image::create([
            'path' => $path,
        ]);
        return "Uplode Ok";
        
    }
}
