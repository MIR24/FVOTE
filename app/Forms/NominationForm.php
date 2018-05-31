<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NominationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Имя', 'rules' => 'required|string|max:255'])
            ->add('from_time', 'datetime-local', ['label' => 'Время начала'])
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
