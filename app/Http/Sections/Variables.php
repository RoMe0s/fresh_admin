<?php

namespace App\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use SleepingOwl\Admin\Contracts\Initializable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminColumn;
use AdminColumnEditable;
use App\Models\Variable;

/**
 * Class Variables
 *
 * @property \App\Models\Variable $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Variables extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Переменные';

    /**
     * @var string
     */
    protected $alias;

    public function initialize() {

        $this->addToNavigation(999)->setIcon('fa fa-cog');
    
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::link('key', 'Ключ'),
                AdminColumn::text('description', 'Описание')
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {

        $variable = Variable::find($id);
        
        $type = isset($variable) ? $variable->type : null;

        $field = isset($type) ? AdminFormElement::{$type}('value', 'Значение') : '';

        switch ($type) {

            case 'multiselect':

                $field = $field->taggable()->setHelpText("Введите новое значение и нажмите \"Enter\"")->setOptions($variable->value);

                break;

            case 'wysiwyg':

                $field = $field->setEditor('simplemde');

                break;

        }

        $attention = isset($variable) ? "Будьте внимательны, при смене типа старая информация может не подойти" : "Вначале нужно выбрать тип переменной и сохранить";

        return AdminForm::form()->setElements([

                AdminFormElement::text('key', 'Ключ переменной')->required()->unique(),

                AdminFormElement::text('description', 'Описание'),

                AdminFormElement::html('<div class="alert alert-warning">' . $attention . '</div>'),

                AdminFormElement::select('type', 'Тип', Variable::getTypes())->required(),

                $field

            ]);

    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
    
    public function getCreateTitle() {

        return 'Создание переменной';
    
    }
}
