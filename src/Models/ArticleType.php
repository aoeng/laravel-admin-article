<?php

namespace Aoeng\Laravel\Admin\Article\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ArticleType extends Model
{
    use HasFactory, DefaultDatetimeFormat;

    protected $guarded = [];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_type_map', 'article_type_id', 'article_id');
    }
}
