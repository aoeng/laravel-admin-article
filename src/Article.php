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

    }

}
