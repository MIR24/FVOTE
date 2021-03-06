<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NominationForm extends Form
{

    public function buildForm()
    {
        $model = $this->getData('model');

        if (!is_object($model)) {
            $this->add('ntype', 'choice', [
                'label' => 'Тип номинации',
                'choices' => config('ntype.name'),
                'selected' => 1,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
            ]);
        } else {
            $this->add('Тип номинации', 'static', [
                'tag' => 'div', // Tag to be used for holding static data,
                'attr' => ['class' => 'form-control-static'], // This is the default
                'value' => config('ntype.name')[$model->ntype]
            ]);
            $this->add('ntype', 'hidden');
        }
        $this->add('name', 'text', ['label' => 'Имя', 'rules' => 'required|string|max:255']);
        $this->add('from_time', 'datetime-local', ['label' => 'Время начала'])
                ->add('to_time', 'datetime-local', ['label' => 'Время окончания'])
                ->add('status', 'choice', [
                    'label' => 'Статус',
                    'choices' => ['inactive' => 'Неактивна', 'active' => 'Активна'],
                    'selected' => 'inactive',
                    'choice_options' => [
                        'wrapper' => ['class' => 'choice-wrapper'],
                        'label_attr' => ['class' => 'label-class'],
                    ],
                    'expanded' => true
                ])
                ->add('submit', 'submit', ['label' => 'Принять'])
                ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
