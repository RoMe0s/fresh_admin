<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use FrontMeta;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $data = array();

    public $user = null;

    function __construct()
    {

        $this->user = Auth::user();

        view()->share('user', $this->user);

    }

    public function data(string $key, $value) {
    
        $this->data[$key] = $value;
    
    }

    public function render(string $view, array $parameters = array()) {

        $parameters = array_merge($parameters, $this->data);

        return view($view)->with($parameters);
    
    }

    public function fillMeta($model)
    {
        FrontMeta::title($model->getMetaTitle());
        FrontMeta::description($model->getMetaDescription());
        FrontMeta::keywords($model->getMetaKeywords());
        FrontMeta::image($model->getMetaImage());
        FrontMeta::canonical($model->getUrl());
        FrontMeta::url($model->getUrl());
    }

}
