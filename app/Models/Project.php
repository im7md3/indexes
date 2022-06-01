<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable=['name','notes','status','password'];

    public function departments(){
        return $this->hasMany(Department::class)->whereNull('parent_id');
    }

    public function branches(){
        return $this->hasMany(Department::class)->whereNotNull('parent_id');
    }
    public function subBranches(){
        return $this->hasMany(Department::class,'parent_id')->whereNotNull('parent_id')->where('type','2');
    }

}
