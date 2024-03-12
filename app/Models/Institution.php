<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['institute_name', 'created_by', 'updated_by'];

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
        return $this->hasMany(User::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
