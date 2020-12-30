<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;

    protected $fillable = [
        'auth_name',
        'ssh_pass',
        'ssh_key',
        'a_owner_id',
    ];

    /**
     * Authenticationsテーブルから取得したデータを返すメソッド
     */
    public function getArrayParams($target){

        $this->id = $target[0]['id'];
        $this->auth_name = $target[0]['auth_name'];
        $this->ssh_pass = $target[0]['ssh_pass'];
        $this->ssh_key = $target[0]['ssh_key'];
        $this->a_owner_id = $target[0]['a_owner_id'];

        return $this;
    }

    /**
     * 認証情報変更の認証
     * @param  $user_id, $playbook_id
     */
    public static function authRun($user_id, $auth_id){
        # システム管理者であれば認証を通す
        if ($user_id->role == 1){
            return 0;
        # playbookの所有者であれば認証を通す
        } elseif ($user_id->id == $auth_id[0]['a_owner_id']){
            return 0;
        # それ以外は403エラー
        } else {
            abort(403, 'Forbidden');
            header('Location: /home', true, 403);
            exit();
        }
    }

    /**
     * 認証情報閲覧前の認証
     * @param  $user_id, $playbook_id
     */
    public static function authView($user_id, $auth_id){
        # システム管理者,またはread権限者であれば認証を通す
        if ($user_id->role == 1 || $user_id->role == 15){
            return 0;
        # playbookの所有者であれば認証を通す
        } elseif ($user_id->id == $auth_id[0]['a_owner_id']){
            return 0;
        # それ以外は403エラー
        } else {
            abort(403, 'Forbidden');
            header('Location: /home', true, 403);
            exit();
        }
    }


}
