<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Role;

class UserForm extends Form
{
    public function buildForm()
    {
        $collection = Role::select(['name'])
            ->take(config('default.limit'))
            ->get();
        $choices = [];
        foreach ($collection as $model) {
            $choices[$model->name] = __($model->name);
        }
        $this
            ->add('name', 'text', ['label' => 'Имя', 'rules' => 'required|string|max:255'])
            ->add('email', 'text', ['label' => 'E-Mail Адрес', 'rules' => 'required|string|email|max:255'])
            ->add('filial', 'text', ['label' => 'Филиал', 'rules' => 'max:255'])
            ->add('note', 'textarea', ['label' => 'Заметка', 'rules' => 'max:255'])
            ->add('status', 'choice', [
                'choices' => ['inactive' => 'Неактивен', 'active' => 'Активен'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'label' => 'Статус',
                'rules' => 'required',
                'expanded' => true
            ])
            ->add('role', 'choice', [
                'choices' => $choices,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'label' => 'Роль',
                'rules' => 'required'
            ])
            ->add('submit', 'submit', ['label' => 'Принять'])
            ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
