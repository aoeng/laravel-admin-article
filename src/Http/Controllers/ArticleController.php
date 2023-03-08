<?php

namespace Aoeng\Laravel\Admin\Article\Http\Controllers;

use Aoeng\Laravel\Admin\Article\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

/**
 *
 * @group  文章相关 ArticleController
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * 文章列表  ArticleController_index
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
            ->select(['id', 'title', 'picture', 'sort', 'created_at'])
            ->where('is_display', 1)
            ->orderByDesc('sort')
            ->paginate();

        return $this->responseJson($article);
    }

    /**
     * 文章详情  ArticleController_show
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

    public function upload(Request $request)
    {

        $url = '';

        $image = $request->file('upload');

        $fileName = $image->getFilename() . time() . date('ymd') . '.' . $image->getClientOriginalExtension();

        $pathName = config('admin.upload.directory.file') . date('Y/m/d');

        if ($path = Storage::putFileAs($pathName, $image, $fileName)) {
            $url = Storage::url($path);
        }

        return response()->json([
            'uploaded' => 1,
            'fileName' => $fileName,
            'url'      => $url
        ]);
    }

}
