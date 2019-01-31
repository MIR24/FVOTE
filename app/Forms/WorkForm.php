<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Nomination;

class WorkForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Имя', 'rules' => 'required|string|max:255'])
            ->add('url', 'text', ['label' => 'Ссылка на сюжет', 'rules' => 'required|string|max:255'])
            ->add('filial', 'text', ['label' => 'Филиал', 'rules' => 'required|string|max:255'])
            ->add('correspondent', 'text', ['label' => 'Корреспондент', 'rules' => 'required|string|max:255'])
            ->add('operator', 'text', ['label' => 'Оператор', 'rules' => 'required|string|max:255'])
            ->add('nomimation', 'hidden', ['value' => $this->getData('nomimation')])
            ->add('submit', 'submit', ['label' => 'Принять'])
            ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
