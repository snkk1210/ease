<?php

namespace App\Lib;

class SecurityFunction
{
    /**
     * 渡された値に ../ が含まれていれば 処理中断しエラーページを表示
     * 
     * @param string $input
     */
    public static function directoryTraversalDetection($input){
        $path_check = preg_match('/(\.\.\/)/', $input) ? 1 : 0;
        if($path_check){
            abort(400, 'Directory Traversal Detected');
        }
    }

    /**
     * 渡された値(パス)が存在しなければ(ディレクトリでなければ) 処理中断しエラーページを表示
     * 
     * @param string $input
     */
    public static function directoryPathExists($input){
        if(!file_exists($input) || is_file($input)){
            abort(400, 'Directory Not Found');
        }
    }
}

?>