<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function scopeFilter($query, array $filter){
        // ويش ذا الزين!!
        $query->when($filter['search'] ?? false, function($query,$search){ 
            
        $query
                ->where('title', 'like', '%'  . $search .'%')
                ->orWhere('body', 'like', '%' . $search . '%');
      });
    }
}
