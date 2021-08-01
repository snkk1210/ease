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
    public function show(Request $request){
        
        $directory = $request->directory;

        $lst = array();
        $curdir = getcwd();
        $serchdir = $curdir . "/../storage/app/uploads/" . $directory;
        $dhandle = opendir($serchdir);
        if ($dhandle){
            while (false !== ($fname = readdir($dhandle))){
                if ($fname != '.' && $fname != '..'){
                    $list[] = $fname;
                }
            }
            closedir($dhandle);
        }
        print_r($list);
    }

    /**
     *
     */
    public function store(Request $request){

        $files = $request->file('file');

        $directory = $request->directory;

        foreach($files as $file){

            var_dump($file->getClientOriginalName());

        }

    }

}
