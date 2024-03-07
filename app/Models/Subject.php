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
        return $this->belongsToMany(User::class, 'user_subjects', 'user_id', 'subject_id');
    }

    // public function teacher()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
