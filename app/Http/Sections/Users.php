<?php

namespace App\Http\Sections;

use App\Models\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use SleepingOwl\Admin\Contracts\Initializable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminColumn;
use Spatie\Permission\Models\Role;

/**
 * Class Users
 *
 * @property \App\Models\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section
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
    protected $title = 'Администраторы';

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
            ->with('roles')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::link('name', 'Имя'),
                AdminColumn::email('email', 'Email'),
                AdminColumn::lists('roles.name', 'Группы')
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $panel = AdminForm::panel()
            ->addElement(AdminDisplay::tabbed()->setTabs(function () use ($id) {

                $tabs = [];

                $tabs[] = AdminDisplay::tab(

                    AdminForm::elements([

                        AdminFormElement::text('name', 'Имя пользователя')->required(),
                        AdminFormElement::text('email', 'E-mail')->required()->addValidationRule('email'),
                        AdminFormElement::multiselect('roles', 'Роли', Role::class)->setDisplay('name')->required()

                    ])

                )->setLabel("Основное");

                $tabs[] = AdminDisplay::tab(AdminForm::elements([

                    AdminFormElement::password('password', 'Пароль')->addValidationRule('min:6')
                ]))->setLabel('Смена пароля');

                return $tabs;
            }));

        return $panel;
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return string
     */
    public function getCreateTitle() {

        return 'Создание пользователя';

    }
}
