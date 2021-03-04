<?php

namespace Aoeng\Laravel\Admin\Article\Admin\Controllers;

use Aoeng\Laravel\Admin\Article\Models\ArticleType;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Controllers\AdminController;

class ArticleTypeController extends AdminController
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章分类';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleType());

        $grid->column('id', __('Id'));
        $grid->column('flag', __('Flag'))->filter('like');
        $grid->column('name', __('Name'))->editable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->disableFilter();
        $grid->disableCreateButton();
        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('flag', __('Flag'));
            $create->text('name', __('Name'));
        });


        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableEdit();
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
        $show = new Show(ArticleType::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('flag', __('Flag'));
        $show->field('name', __('Name'));
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
        $form = new Form(new ArticleType());

        $form->text('flag', __('Flag'))->required();
        $form->text('name', __('Name'))->required();

        return $form;
    }
}
