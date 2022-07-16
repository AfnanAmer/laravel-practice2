<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'author'];

    protected function scopeFilter($query, array $filter)
    {
        // ويش ذا الزين!!
        $query->when($filter['search'] ?? false,  fn ($query, $search) =>

        $query
            ->where('title', 'like', '%'  . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%'));


        $query->when($filter['category'] ?? false, fn ($query, $category) =>
        $query->whereHas(
            'category',
            fn ($query) =>
            $query->where('slug', $category)
        ));

        $query->when($filter['author'] ?? false, fn ($query, $author) =>
        $query->whereHas(
            'author',
            fn ($query) =>
            $query->where('username', $author)
        ));

        // $query->when($filter['category'] ?? false,fn ($query, $category) =>
        //     $query
        //         ->whereExists(fn ($query) =>
        //         $query->from('categories')
        //             ->whereColumn('categories.id', 'posts.category_id')
        //             ->where('categories.slug', $category))
        // );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
