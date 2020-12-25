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
}
