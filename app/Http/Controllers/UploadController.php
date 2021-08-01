<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * 
     */
    public function index(){
        //
        return view('upload');
    }

    /**
     * 
     */
    public function show(){
        //
    }

    /**
     * 
     */
    public function store(Request $request){

        $files = $request->file('file');

        foreach($files as $file){
            var_dump($file->getClientOriginalName());
        }

    }

}
