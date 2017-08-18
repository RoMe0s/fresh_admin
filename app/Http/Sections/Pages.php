<?php

namespace App\Http\Sections;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminColumn;
use AdminColumnEditable;
use App\Models\Page;

/**
 * Class Pages
 *
 * @property \App\Models\Page $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Pages extends Section
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
    protected $title = 'Страницы';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::link('name', 'Название'),
                AdminColumn::text(function($model) {

                    return '<a target="_blank" href="' . $model->getUrl() . '">Перейти</a>';


                }, 'Ссылка'),
                AdminColumnEditable::checkbox('status', 'Включен', 'Выключен')->setLabel('Статус')
            ])->paginate(20);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {

        $panel = AdminForm::panel()
            ->addElement(AdminDisplay::tabbed()->setTabs(function () {

                $tabs = [];

                $tabs[] = AdminDisplay::tab(

                    AdminForm::elements([

                        AdminFormElement::text("name", 'Название')->required(),

                        AdminFormElement::ckeditor("content", 'Контент'),

                        AdminFormElement::text("meta_title", 'Мета имя'),

                        AdminFormElement::textarea("meta_keywords", 'Ключевые слова'),

                        AdminFormElement::textarea("meta_description", 'Мета описание')

                    ])

                )->setLabel("Контент");

                $tabs[] = AdminDisplay::tab(AdminForm::elements([

                    AdminFormElement::image2('image', 'Картинка'),

                    AdminFormElement::select('slug', 'Ссылка', Page::getSlugs())->required()->unique()->addValidationRule('without_spaces'),

                    AdminFormElement::select('template', 'Шаблон', Page::getTemplates())->required()->nullable(),

                    AdminFormElement::select('status', 'Статус', [1 => 'Включен', 0 => 'Выключен'])->required()

                ]))->setLabel('Основное');

                return $tabs;
            }));

        return $panel;

    }

    /**
     * @return string
     */
    public function getCreateTitle()
    {

        return 'Создание страницы';

    }
}
