<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
