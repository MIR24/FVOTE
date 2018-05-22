<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Nomination;

class WorkForm extends Form
{
    public function buildForm()
    {
        $collection = Nomination::select(['id', 'name'])
            ->take(config('default.limit'))
            ->get();
        $choices[0] = 'Нет';
        foreach ($collection as $model) {
            $choices[$model->id] = $model->name;
        }
        $this
            ->add('name', 'textarea', ['label' => 'Имя', 'rules' => 'required|string|max:255'])
            ->add('url', 'text', ['label' => 'Ссылка на сюжет', 'rules' => 'required|string|max:255'])
            ->add('filial', 'textarea', ['label' => 'Филиал', 'rules' => 'required|string|max:255'])
            ->add('correspondent', 'text', ['label' => 'Корреспондент', 'rules' => 'required|string|max:255'])
            ->add('operator', 'text', ['label' => 'Оператор', 'rules' => 'required|string|max:255'])
            ->add('nomimation', 'choice', [
                'choices' => $choices,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'label' => 'Номинация'
            ])
            ->add('submit', 'submit', ['label' => 'Принять'])
            ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
