<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'color',
        'choose',
        'notify',
        'user_id',
        'category_id'
    ];
    use HasFactory;
}
