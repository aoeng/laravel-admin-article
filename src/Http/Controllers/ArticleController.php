<?php

namespace Aoeng\Laravel\Admin\Article\Http\Controllers;

use Aoeng\Laravel\Admin\Article\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *
 * @group  文章 ArticleController
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * 文章列表  article_index
     *
     * @bodyParam type string required 分类的flag
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $article = Article::query()
            ->when($request->input('type', false), function ($query, $type) {
                $query->whereHas('types', function ($query) use ($type) {
                    $query->where('flag', $type);
                });
            })
            ->where('is_display', 1)
            ->paginate();

        return $this->responseJson($article);
    }

    /**
     * 文章详情  article_show
     *
     * @bodyParam id string required ID
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $article = Article::query()->where('is_display', 1)->find($request->input('id', 0));

        return $this->responseJson($article);
    }

}
