<?php

namespace App\Models;

use App\Traits\ImageTrait;
use App\Traits\VisibleTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MetaTrait;
use App\Interfaces\MetaInterface;

class Page extends Model implements MetaInterface
{

    use MetaTrait;
    use VisibleTrait;
    use ImageTrait;

    protected $fillable = [
        'slug',
        'status',
        'image',
        'template',

        'name',
        'content',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function getUrl() {

        if($this->slug === "home") {

            return route('home');

        }

        return route('pages', ['slug' => $this->slug]);
    
    }

    public static function getTemplates() {

        return [
            'default' => 'Стандартный',
            'basket' => 'Корзина',
            'contacts' => 'Контакты',
            'blog' => 'Полезное'
        ];

    }

    public static function getSlugs() {

        return [
            'home' => 'Главная',
            'basket' => 'Корзина',
            'contacts' => 'Контакты',
            'blog' => 'Полезное'
        ];

    }

    public function getMetaTitle()
    {
        return $this->meta_title ? : strip_tags($this->name);
    }

}
