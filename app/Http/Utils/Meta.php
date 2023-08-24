<?php

namespace App\Http\Utils;

use Illuminate\Support\Env;

class Meta
{
    // properties
    protected static string $title;
    protected static string $description;
    protected static string $image;


    public static string $keyWord = 'Pengolahan Air Bersih dan Air Limbah';

    public function __construct(string $title, string $description, string $image)
    {
        static::$title = $title;
        static::$description = $description;
        static::$image = $image;
    }

    public static function getTitle()
    {
        return self::$title;
    }

    // render meta
    public static function render()
    {
        $html = '';
        $html .= '<meta name="title" content="' . self::$title . '"/>' . PHP_EOL . '    ';
        $html .= '<meta name="description" content="' . self::$description . '"/>' . PHP_EOL . '    ';
        $html .= '<meta name="keywords" content="' . self::$title . '"/>' . PHP_EOL . '    ';
        $html .= '<meta property="og:title" content="' . self::$title . '"/>' . PHP_EOL . '    ';
        $html .= '<meta property="og:site_name" content="' . self::$title . '"/>' . PHP_EOL . '    ';
        $html .= '<meta property="og:title" content="' . self::$title . '"/>' . PHP_EOL . '    ';
        $html .= '<meta property="og:description" content="' . self::$description . '"/>' . PHP_EOL . '    ';
        $html .= '<meta property="og:url" content="' . url()->full() . '"/>' . PHP_EOL . '    ';
        $html .= '<meta property="og:image" content="' . env('APP_URL')  . self::$image . '"/>' . PHP_EOL . '    ';
        $html .= '<link rel="canonical" href="' . url()->full() . '">' . PHP_EOL . '    ';
        $html .= '<meta property="og:type" content="website"/>' . PHP_EOL . '    ';
        return $html;
    }
}
