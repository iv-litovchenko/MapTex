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
                print  $prefix . ' ' . $category->name;
                print_r($arTree);
                exit();
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($postsList, $arTree);
        return $arTree;
    }
}
