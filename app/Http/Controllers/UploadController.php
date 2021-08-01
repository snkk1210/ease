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

        foreach($files as $file){

            var_dump($file->getClientOriginalName());

        }

    }

}
