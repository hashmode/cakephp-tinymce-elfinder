<?php
use Cake\Routing\Router;

Router::plugin(
    'CakephpTinymceElfinder',
    ['path' => '/cakephp-tinymce-elfinder'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);