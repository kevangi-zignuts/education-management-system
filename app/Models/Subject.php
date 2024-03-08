<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['subject_name'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_subjects', 'subject_id', 'user_id');
    }
}
