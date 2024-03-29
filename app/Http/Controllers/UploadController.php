<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\SecurityFunction;
use App\Models\Authentication;
use Illuminate\Support\Facades\Auth;
use App\Models\Playbook;

class UploadController extends Controller
{
    /**
     * ファイルアップロードのフォームを表示
     */
    public function index(){
        //
        return view('upload');
    }

    /**
     * 入力されたディレクトリ内の情報を表示
     * 
     * @param  Request  $request
     */
    public function show(Request $request){
        
        $directory = $request->directory;

        $lst = array();
        $curdir = getcwd();
        $serchdir = $curdir . "/../storage/app/uploads/" . $directory;

        SecurityFunction::directoryTraversalDetection($directory);

        SecurityFunction::directoryPathExists($serchdir);

        /* # NOTE: シェルコマンドだと見栄えが悪いので未採用
        $exec_ls = "ls -l $serchdir";
        exec($exec_ls, $lists, $return_code);
        */

        $dhandle = opendir($serchdir);
        $lists[] = "";
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
     * アップロードされたファイルを保存
     * 
     * @param  Request  $request
     */
    public function store(Request $request){

        $id = Auth::id();
        $target_data = Playbook::where('id', $id)->get();
        $user = Auth::user();
        Authentication::authUpload($user, $target_data);

        $files = $request->file('file');

        $directory = $request->directory;
        $deploydir = "uploads/" . $directory;

        SecurityFunction::directoryTraversalDetection($deploydir);

        foreach($files as $file){

            $fname = $file->getClientOriginalName();
            $file->storeAS($deploydir,$fname);

            chmod("../storage/app/" . $deploydir . "/" . $fname, 0600);
        }

        return view('upload');
    }

}
