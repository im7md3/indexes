<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=['name','project_id','parent_id','description','title','type','file','isComment'];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function branches(){
        return $this->hasMany(Department::class,'parent_id');
    }
    public function subBranches(){
        return $this->hasMany(Department::class,'parent_id')->where('type','2');
    }
    public function department(){
        return $this->belongsTo(Department::class,'parent_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }
}
