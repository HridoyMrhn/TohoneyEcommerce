<?php

use App\Models\Category;

function cateogries(){
    return Category::with('subcategory')->orderBy('name', 'desc')->get();
}
