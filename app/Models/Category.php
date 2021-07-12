<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'cc_id');
    }

    public function subcategory(){
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}

