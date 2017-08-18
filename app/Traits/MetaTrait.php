<?php

namespace App\Traits;

trait MetaTrait {

    public function getMetaTitle() {

        return $this->meta_title ?: $this->name;
    
    }

    public function getMetaDescription() {

        return $this->meta_description;
    
    }

    public function getMetaKeywords() {
    

        return $this->meta_keywords;
    
    }

    public function getMetaImage() {

        return $this->image ? url($this->image) : null;
    
    }

}
