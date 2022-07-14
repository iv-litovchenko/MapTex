<?php

namespace App\Utils;

use App\Models\Post;

class FrontendUility
{
    /**
     * Функция генерирует дерево записей из модели в массив
     *
     * @return array
     */
    public static function buildTreeArray()
    {
        $postsList = Post::orderBy('sorting', 'asc')->get()->toTree();
        $arTree = [];
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$arTree) {
            foreach ($categories as $category) {
                $arTree[$category->id] = $prefix.' '.$category->name;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($postsList);
        return $arTree;
    }
}
