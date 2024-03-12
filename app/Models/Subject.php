<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['subject_name', 'created_by', 'updated_by'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($institution) {
            $user = auth()->user();
            if ($user) {
                $institution->created_by = $user->id;
            }
        });

        static::updating(function ($institution) {
            $user = auth()->user();
            if ($user) {
                $institution->updated_by = $user->id;
            }
        });
    }

    public function user(){
        return $this->belongsToMany(User::class, 'user_subjects', 'subject_id', 'user_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
