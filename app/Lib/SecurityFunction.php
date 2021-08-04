<?php

namespace App\Lib;

class SecurityFunction
{
    /**
     * 渡された値が ../ であれば 処理中断
     * 
     * @param string $input
     */
    public static function directoryTraversalDetection($input){
        $path_check = preg_match('/(\.\.\/)/', $input) ? 1 : 0;
        if($path_check){
            abort(400, 'Directory Traversal Detected');
            return 0;
        }
    }
}

?>