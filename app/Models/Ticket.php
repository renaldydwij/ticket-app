<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name_customer',
        'name',
        'email',
        'comment',
        'image',
        'name_status',
        'name_priority',
        'development'
        ];
}
