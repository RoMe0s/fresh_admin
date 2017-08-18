<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 7/14/17
 * Time: 4:28 PM
 */

namespace App\Traits;


trait PositionSortedTrait
{

    public function scopePositionSorted($query, $field = 'order', $type = 'ASC') {

        return $query->orderBy($field, $type);

    }

}