<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    static $validation_rules = [
        'email' => 'required|email',
        'nim' => 'required',
        'name' => 'required',
        'year' => 'required',
        'photo' => 'file|image'
    ];

    protected $table = 'students';
    protected $guarded = [];
    protected $dates = ['birthdate'];
    public $incrementing = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
    
    public function theses()
    {
        return $this->hasMany(Theses::class, 'student_id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function getEmailAttribute($value)
    {
        return optional($this->user)->email;
    }

    public function getPhotoPath(){
        if($this->photo != null){
            return 'storage/photo/lecturer/'.$this->photo;
        }
        return 'img/default-user.png';
    }

    public function theses()
    {
        return $this->hasOne(Theses::class);
    }

    public function thesis()
    {
        return $this->hasOne(Thesis::class, 'student_id');
    }

}
