<?php

namespace PHPPlusPlus\View;

class View
{
    public static function make($view, $data = [])
    {
        $baseContent = self::getBaseContent();

        $viewContent = self::getViewContent($view, params: $data);

        echo str_replace('{{ content }}', $viewContent, $baseContent);
    }

    private static function getBaseContent(): string
    {
        ob_start();

        include base_path() . '/views/layouts/main.php';

        return ob_get_clean();
    }

    private static function getViewContent($view, $isError = false, $params = []): string
    {
        $path = $isError ? view_path() . 'errors/' : view_path();

        if(is_string($view)) {
            $dirs = explode('.', $view);
            foreach ($dirs as $dir) {
                if(is_dir($path . '/' . $dir)) {
                    $path .= $dir . '/';
                }
            }
            $view = $path . end($dirs) . '.php';
        } else {
            $view = $path . $view . '.php';
        }

        foreach ($params as $key => $value) {
            $$key = $value;
        }
        if ($isError) {
           include $view;
        } else {
            ob_start();

            include $view;

            return ob_get_clean();
        }
    }


    public static function makeError($view)
    {
        return self::getViewContent($view, isError: true);
    }


}