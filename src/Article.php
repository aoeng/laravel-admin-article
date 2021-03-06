<?php


namespace Aoeng\Laravel\Admin\Article;


use Encore\Admin\Extension;

class Article extends Extension
{
    public $name = 'article';

    public function __construct()
    {
        self::routes(__DIR__ . '/../routes/admin.php');
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::import();

        parent::createMenu('文章管理', '/', 'fa-book', 0, [
            ['title' => '文章分类', 'path' => 'article-types', 'icon' => 'fa-bookmark'],
            ['title' => '文章列表', 'path' => 'articles', 'icon' => 'fa-align-justify'],
        ]);
    }

}
