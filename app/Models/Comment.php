<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['name','department_id','content','file','file_ext'];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
