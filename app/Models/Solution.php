<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'h',
        'i',
        'e',
        'r',
        'g',
        'b',
        't',
        's',
        'n',
        'u',
        'iterations'
    ];
}