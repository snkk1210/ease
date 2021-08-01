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

        $path_check = preg_match('/(\.\.\/)/', $directory) ? 1 : 0;
        if($path_check){ return "Directory Traversal measures"; }

        /* # NOTE: シェルコマンドだと見栄えが悪いので未採用
        $exec_ls = "ls -l $serchdir";
        exec($exec_ls, $lists, $return_code);
        */

        $dhandle = opendir($serchdir);
        if ($dhandle){
            while (false !== ($fname = readdir($dhandle))){
                if ($fname != '.' && $fname != '..'){
                    $lists[] = $fname;
                }
            }
            closedir($dhandle);
        }

        return view('upload' ,[
            "lists" => $lists,
        ]);
    }

    /**
     *
     */
    public function store(Request $request){

        $files = $request->file('file');

        $directory = $request->directory;
        $deploydir = "uploads/" . $directory;
 
        $path_check = preg_match('/(\.\.\/)/', $deploydir) ? 1 : 0;
        if($path_check){ return "Directory Traversal measures"; }

        foreach($files as $file){

            $fname = $file->getClientOriginalName();
            $file->storeAS($deploydir,$fname);

        }

        return view('upload');
    }

}
