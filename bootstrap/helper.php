<?php

if (!function_exists('app_title')) {
    function app_title(): string
    {
        $viewTitle = View::getSection('title', '');

        if (!empty($viewTitle)) {
            $viewTitle .= ' | ';
        }

        return $viewTitle . config('app.name');
    }
}
