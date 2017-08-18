<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 8/17/17
 * Time: 9:01 PM
 */

namespace App\Classes;

use SleepingOwl\Admin\Contracts\ModelConfigurationInterface;
use SleepingOwl\Admin\Form\FormButtons as AdminFormButtons;

class FormButtons extends AdminFormButtons
{

    /**
     * @deprecated new version available
     * @return $this
     */
    public function hideDeleteButton()
    {
        $this->showDeleteButton = false;

        if(isset($this->buttons['delete'])) {

            unset($this->buttons['delete']);

        }

        return $this;
    }

    public function getButtons()
    {

        if(!$this->getModel()->getKey()) {

            $this->hideDeleteButton();

        }

        return parent::getButtons();
    }

}