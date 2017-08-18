<?php

if (!function_exists('page_service')) {

    function page_service(string $slug, array $with = array())
    {

        $pageServie = new \App\Services\PageService($slug, $with);

        return $pageServie->fillMeta()->getPage();

    }

}

if (!function_exists('get_href')) {

    function get_href(string $href)
    {

        if (request()->url() != $href) {

            return "href='$href'";

        }

    }

}

if (!function_exists('compare_href')) {

    function compare_href(string $href, $attribute = "checked")
    {

        return request()->url() == $href ? $attribute : "";

    }

}

if (!function_exists('exception_mail')) {

    function exception_mail(string $message)
    {

        \Illuminate\Support\Facades\Mail::to(config('mail.username'))->queue(new \App\Mail\ExceptionLogger($message));

    }

}

if (!function_exists('variable')) {

    function variable(string $key = null, $default = null)
    {

        if (is_null($key)) {

            return app('variable');

        }

        return app('variable')->get($key, $default);

    }

}

if (!function_exists("messages")) {

    function messages(string $type, string $message)
    {

        $messages = session()->get("flash_messages", []);

        $messages[$type][] = $message;

        session()->put('flash_messages', $messages);

    }

}

if (!function_exists('formatSizeUnits')) {

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}

if (!function_exists('thumb')) {
    /**
     * @param string $path
     * @param int|null $width
     * @param int|null $height
     * @param boolean $aspectRatio
     *
     * @return string
     *
     */
    function thumb($path = '', $width = null, $height = null, $aspectRatio = false)
    {
        $width = $width ?: $height;

        $height = $height ?: $width;

        $exists = thumb_exists($path, "_{$width}x{$height}");

        if($exists !== FALSE) {

            return $exists;

        }

        if (!$width && !$height) return 'http://www.placehold.it/100x100/EFEFEF/AAAAAA&text=no+image';

        $path = File::exists(public_path($path)) ? $path : false;

        return $path ?
            url(Thumb::thumb($path, $width, $height, $aspectRatio)->link()) :
            'http://www.placehold.it/' . $width . 'x' . $height . '/EFEFEF/AAAAAA&text=no+image';
    }
}

if (!function_exists('thumb_exists')) {

    function thumb_exists(string $path, string $postfix = null)
    {

        if (strpos($path, public_path()) === false) {
            $path = public_path($path);
        }

        if (!\Illuminate\Support\Facades\File::exists($path) || !is_file($path)) {

            return false;

        }

        $path_info = pathinfo($path);

        $file_name = md5($path_info['filename']);

        $path = substr($file_name, 0, 2) . '/' . substr($file_name, 2, 2);

        $path = public_path('thumbs/' . $path);

        $file = $path . '/' . $file_name . $postfix . '.' . $path_info['extension'];

        if(\Illuminate\Support\Facades\File::exists($file) !== FALSE) {

            return url(str_replace(public_path() . '/', '', $file));

        }

        return false;

    }

}