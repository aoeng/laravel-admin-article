laravel-admin extension 文章管理
=====

## 安装

```bash
composer require  aoeng/laravel-admin-article
```

导入菜单

```bash
php artisan admin:import article
```

配置编辑器 `admin.php`的扩展配置里加上

``` 
 'ckeditor' => [

            //Set to false if you want to disable this extension
            'enable' => true,

            // Editor configuration
            'config' => [
                'filebrowserImageUploadUrl' => '/editor/upload?',
                'image_previewText' => ' ',
                'lang'   => 'zh-CN',
                'height' => 500
            ]
        ],
```
其他编辑器配置`editor`
```injectablephp
Form::extend('editor', ...);
```
