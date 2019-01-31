<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Nomination;

class WorkForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Месяц: Название сюжета', 'rules' => 'required|string|max:255'])
            ->add('url', 'text', ['label' => 'Ссылка', 'rules' => 'required|string|max:255'])
            ->add('filial', 'text', ['label' => 'Филиал', 'rules' => 'required|string|max:255'])
            ->add('correspondent', 'text', ['label' => 'Корреспондент', 'rules' => 'required|string|max:255'])
            ->add('operator', 'text', ['label' => 'Оператор', 'rules' => 'required|string|max:255'])
            ->add('nomination', 'hidden', ['value' => $this->getData('nomination')])
            ->add('submit', 'submit', ['label' => 'Принять'])
            ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
