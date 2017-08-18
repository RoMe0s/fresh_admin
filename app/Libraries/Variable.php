<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Cache;
use App\Models\Variable as VariableModel;

class Variable
{

    protected $data;

    protected $selected;

    function __construct()
    {

        $this->data = Cache::remember('variables', 10, function () {

            return VariableModel::get()->keyBy('key');

        });

    }

    public function get(string $key, $default = null)
    {

        $result = isset($this->data[$key]) ? $this->data[$key] : $default;

        if ($result instanceof VariableModel) {

            switch ($result->type) {

                case 'image':

                    $result = url($result->value);

                    break;

                case 'multiselect':

                    try {

                        $result = array_values($result->value);

                    } catch (\Exception $e) {

                        $result  = [];

                    }

                    break;

                case 'textarea':

                    $result = strip_tags($result->value);

                    break;

                default:

                    $result = $result->value;

                    break;

            }

        }

        return $result;

    }

}
