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
    ];

    /**
     * playbooksテーブルから取得したデータを返すメソッド
     */
    public function getArrayParams($target){

        $this->name = $target[0]['name'];
        $this->inventory = $target[0]['inventory'];
        $this->main = $target[0]['main'];
        $this->vars = $target[0]['vars'];
        $this->private_key = $target[0]['private_key'];
        $this->repository = $target[0]['repository'];
        $this->enable_flag = $target[0]['enable_flag'];

        return $this;
    }

}
