<?php

if (!function_exists('nova_get_slugs')) {
    function nova_get_slugs()
    {
        $slugs = [];

        $formatPages = function (\Illuminate\Database\Eloquent\Collection $pages, $prefix) use (&$formatPages, &$slugs) {
            $pages->each(function ($page) use (&$slugs, $prefix, &$formatPages) {
                $slugs[$page->id] = ($page->slug !== "/") ? $prefix."/".$page->slug : "/";
                $children = \Sloveniangooner\NovaPager\Models\Page::where('parent_id', $page->id)->where("name->".app()->getLocale(), "!=", null)->get();
                if ($children->count() > 0) {
                    $formatPages($children, $prefix."/".$page->slug);
                }
            });
        };

        $parentPages = \Sloveniangooner\NovaPager\Models\Page::whereNull('parent_id')->where("name->".app()->getLocale(), "!=", null)->get();
        $formatPages($parentPages, "");
        return $slugs;
    }
}
