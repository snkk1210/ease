<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
