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

    protected function scopeFilter($query, array $filter)
    {
        // ويش ذا الزين!!
        $query->when($filter['search'] ?? false,  fn ($query, $search) =>

        $query
            ->where('title', 'like', '%'  . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%'));


        $query->when($filter['category'] ?? false,fn ($query, $category) =>
            $query
                ->whereExist(fn ($query) =>
                $query->from('categories')
                    ->where('categories.id', 'posts.category_id')
                    ->where('categories.slug', $category))
        );
    }
}
