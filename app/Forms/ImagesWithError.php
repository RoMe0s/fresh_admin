<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 8/2/17
 * Time: 4:24 PM
 */

namespace App\Forms;

use Illuminate\Validation\Validator;
use SleepingOwl\Admin\Form\Element\Images;

class ImagesWithError extends Images
{

    public function customValidation(Validator $validator)
    {
        $validator->after(function ($validator) {
            /** @var \Illuminate\Http\UploadedFile $file */
            $file = array_get($validator->attributes(), 'file');

            $size = $file->getSize();

            if (! $size) {
                $validator->errors()->add('file', trans('sleeping_owl::validation.not_image'));
            }
        });
    }

}