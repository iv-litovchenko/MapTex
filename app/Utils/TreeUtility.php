<?php

namespace App\Utils;

use App\Models\Post;

class TreeUtility
{
    /**
     * @return array
     */
    public static function buildingTree()
    {
        $postsList = Post::get()->toTree();
        $arTree = [];
        $traverse = function ($categories, $prefix = '-') use (&$traverse, &$arTree) {
            foreach ($categories as $category) {
                $arTree[$category->id] = PHP_EOL . $prefix . ' [' . $category->id . ']' . ' ' . $category->name;
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($postsList, $arTree);
        return $arTree;
    }
}
