<?php

namespace App;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class lesson extends Model
{
    public $timestamps = false;

    public function getLevelAttribute() {
        $category = Category::find($this->category_id);
        return $category->level;
    }
}
