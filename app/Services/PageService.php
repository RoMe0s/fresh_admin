<?php

namespace App\Services;

use App\Models\Page;
use FrontMeta;

class PageService {

    protected $page;

    function __construct(string $slug, array $with = array()) {

        $this->page = Page::with($with)->visible()->whereSlug($slug)->first();

        return $this;
    
    }

    public function fillMeta() {

        if($this->page) {

            FrontMeta::title($this->page->getMetaTitle());
            FrontMeta::description($this->page->getMetaDescription());
            FrontMeta::keywords($this->page->getMetaKeywords());
            FrontMeta::image($this->page->getMetaImage());
            FrontMeta::canonical($this->page->getUrl());
            FrontMeta::url($this->page->getUrl());

        }

        return $this;
        
    }

    public function getPage() {

        return $this->page;
    
    }

}
