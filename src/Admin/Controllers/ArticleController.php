<?php

namespace Aoeng\Laravel\Admin\Article\Admin\Controllers;

use Aoeng\Laravel\Admin\Article\Models\Article;
use Aoeng\Laravel\Admin\Article\Models\ArticleType;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Controllers\AdminController;

class ArticleController extends AdminController
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章';

    protected function grid()
    {
        $grid = new Grid(new Article());

        $grid->column('id', 'Id');
        $grid->column('types')->display(function ($types) {

            $types = array_map(function ($type) {
                return "<span class='label label-success'>{$type['name']}</span>";
            }, $types);

            return join('&nbsp;', $types);
        });
        $grid->column('title', __('Title'))->filter('like');
        $grid->column('sort', __('Sort'))->editable();
        $grid->column('is_display', __('Is display'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->whereHas('types', function ($query) {
                    $query->whereIn('flag', $this->input);
                });
            }, '类型','flag')->multipleSelect(ArticleType::query()->pluck('name', 'flag'));
            $filter->equal('is_display', __('Is display'))->radio([0 => '隐藏', 1 => '显示',]);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('sort', __('Sort'));
        $show->field('is_display', __('Is display'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article());

        $form->text('title', '标题');
        $form->editor('content', '内容');
        $form->number('sort', '排序')->default(0);
        $form->switch('is_display', '显示?')->default(1);

        return $form;
    }
}
