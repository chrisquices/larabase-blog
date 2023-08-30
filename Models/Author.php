<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'email',
        'bio',
        'facebook',
        'instagram',
        'twitter'
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

}
