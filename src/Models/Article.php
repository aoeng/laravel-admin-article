<?php



namespace Aoeng\Laravel\Admin\Article\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @group 文章 Article
 * Class Article
 * @package App\Models
 */
class Article extends Model
{

    use HasFactory, DefaultDatetimeFormat;

    protected $guarded = [];


    public function types()
    {
        return $this->belongsToMany(ArticleType::class, 'article_type_map', 'article_id', 'article_type_id');
    }
}
