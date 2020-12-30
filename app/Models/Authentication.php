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

}
