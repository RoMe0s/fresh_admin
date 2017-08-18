<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $fillable = [
        'type',
        'key',
        'value',
        'description'
    ];

    public static function getTypes()
    {

        return [
            'textarea' => 'Текст',
            'ckeditor' => 'CKeditor',
            'image' => 'Картинка',
            'multiselect' => 'Массив значений',
            'wysiwyg' => 'HTML'
        ];

    }

    public function setValueAttribute($value)
    {

        if (is_array($value)) {

            $value = json_encode($value);

        }

        $this->attributes['value'] = $value;

    }

    public function getValueAttribute($value)
    {

        if ($this->type === 'multiselect') {

            try {

                $value = json_decode($value);

                $value = array_combine($value, $value);

            } catch (\Exception $e) {

                return [];

            }

        }

        return $value;

    }

}
