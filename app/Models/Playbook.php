<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Authentication;
use Illuminate\Support\Facades\Http;

class Playbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inventory',
        'main',
        'vars',
        'private_key',
        'repository',
        'enable_flag',
        'owner_id',
        'auth_id',
    ];

    /**
     * playbooksテーブルから取得したデータを返すメソッド
     */
    public function getArrayParams($target){

        $this->id = $target[0]['id'];
        $this->name = $target[0]['name'];
        $this->inventory = $target[0]['inventory'];
        $this->main = $target[0]['main'];
        $this->vars = $target[0]['vars'];
        $this->private_key = $target[0]['private_key'];
        $this->repository = $target[0]['repository'];
        $this->enable_flag = $target[0]['enable_flag'];
        $this->auth_id = $target[0]['auth_id'];

        return $this;
    }

    /**
     * playbook実行前の認証
     * @param  $user_id, $playbook_id
     */
    public static function authRun($user_id, $playbook_id){
        # システム管理者であれば認証を通す
        if ($user_id->role == 1){
            return 0;
        # playbookの所有者であれば認証を通す
        } elseif ($user_id->id == $playbook_id[0]['owner_id']){
            return 0;
        # それ以外は403エラー
        } else {
            abort(403, 'Forbidden');
            header('Location: /home', true, 403);
            exit();
        }
    }

    /**
     * playbook閲覧前の認証
     * @param  $user_id, $playbook_id
     */
    public static function authView($user_id, $playbook_id){
        # システム管理者,またはread権限者であれば認証を通す
        if ($user_id->role == 1 || $user_id->role == 15){
            return 0;
        # playbookの所有者であれば認証を通す
        } elseif ($user_id->id == $playbook_id[0]['owner_id']){
            return 0;
        # それ以外は403エラー
        } else {
            abort(403, 'Forbidden');
            header('Location: /home', true, 403);
            exit();
        }
    }

    /**
     * playbook作成時の認証一覧表示
     * @param $user
     */
    public static function getAuthList($user){
        # システム管理者,またはread権限者であれば全認証情報を返す
        if ($user->role == 1 || $user->role == 15){
            $auths = Authentication::all();
        # それ以外は所有物だけ返す
        } else {
            $auths = Authentication::where('a_owner_id', $user->id)->get();
        }
        return $auths;
    }

    /**
     * storage/app以下のレポジトリを取得
     */
    public static function getRepoList(){
        $lst = array();
        $curdir = getcwd();
        $repodir = $curdir . "/../storage/app";
        $dhandle = opendir($repodir);
        if ($dhandle){
            while (false !== ($fname = readdir($dhandle))){
                if ($fname != '.' && $fname != '..' && $fname != 'public' && $fname != '.gitignore'){
                    $list[] = $fname;
                }
            }
            closedir($dhandle);
        }
        return $list;
    }

    /**
     * 実行時Chatwork通知メソッド
     */
    public static function notify2ChatworkStart($user){
        $token = config('chatwork.cw-token');
        $endpoint = config('chatwork.cw-endpoint');
        $date = date("Y/m/d H:i:s");

        $message = "[info][title]EASE Ansible MG started provisioning at " . $date . "[/title]\n" . " by " . $user->name . "[/info]";
        $response = Http::asForm()->withHeaders([
            'X-ChatWorkToken' => $token,
        ])->post($endpoint, [
            'body' => $message
        ]);
        return $response;
    }

    /**
     * 終了時Chatwork通知メソッド
     */
    public static function notify2ChatworkEnd($ansible_output){
        $token = config('chatwork.cw-token');
        $endpoint = config('chatwork.cw-endpoint');
        $date = date("Y/m/d H:i:s");

        $message = "[info][title]EASE Ansible MG ended provisioning at " . $date . "[/title]\n" .  $ansible_output . "[/info]";
        $response = Http::asForm()->withHeaders([
            'X-ChatWorkToken' => $token,
        ])->post($endpoint, [
            'body' => $message
        ]);
        return $response;
    }

}
