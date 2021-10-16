<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name','nationalID','code','phone_number','email','dob','status','position'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
