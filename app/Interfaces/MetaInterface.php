<?php

namespace App\Interfaces;

interface MetaInterface {

    /**
     * @return string|null
     */
    public function getMetaTitle();

    /**
     * @return string|null
     */
    public function getMetaDescription();

    /**
     * @return string|null
     */
    public function getMetaKeywords();

    /**
     * @return string|null
     */
    public function getMetaImage();

    /**
     * @return string|null
     */
    public function getUrl();

}
