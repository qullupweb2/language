<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        'https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
        $this->script = '
        tinymce.init({
            selector:"textarea#'.$this->getElementClassString().'",
            plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table paste imagetools wordcount"
  ],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  
            });
        ';

        return parent::render();
    }
}