<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 8/1/17
 * Time: 7:02 PM
 */
namespace App\Forms;

use Illuminate\Database\Eloquent\Relations\Relation;
use SleepingOwl\Admin\Form\Element\MultiSelect;

class MultiSelect2 extends MultiSelect
{

    public function getView()
    {
        return 'fields.multiselect';
    }

    public function render()
    {
        return view(
            $this->getView(),
            $this->toArray()
        );
    }

    public function getHtmlAttributes()
    {

        $array = parent::getHtmlAttributes();

        $attributes = '';

        foreach ($array as $key => $value) {

            $attributes .= $key . '="' . $value . '" ';

        }

        return $attributes;

    }


    public function getValueFromModel()
    {
        $value = parent::getValueFromModel();

        $old = parent::getValueFromRequest(request());

        $value = !empty($old) ? $old : $value;

        return is_array($value) ? $value : [$value];
    }

}