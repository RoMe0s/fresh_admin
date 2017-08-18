<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 7/21/17
 * Time: 3:30 PM
 */

namespace App\Traits;


trait ImageTrait
{

    public function hasImage(string $field = "image") {

        return !empty($this->{$field}) && file_exists(public_path($this->{$field}));

    }

    public function getImage(string $field = "image") {

        return url($this->{$field});

    }

}