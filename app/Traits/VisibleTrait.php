<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 7/14/17
 * Time: 4:30 PM
 */

namespace App\Traits;


trait VisibleTrait
{

    public function scopeVisible($query, $field = 'status') {

        return $query->where($field, true);

    }

}