<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Nomination;

class WorkFormProducer extends Form
{
    public function buildForm()
    {
        $this
            ->add('filial', 'text', ['label' => 'Филиал', 'rules' => 'required|string|max:255'])
            ->add('correspondent', 'text', ['label' => 'Номинант', 'rules' => 'required|string|max:255'])
            ->add('name', 'textarea', ['label' => 'Обоснование', 'rules' => 'required|string'])
            ->add('nomination', 'hidden', ['value' => $this->getData('nomination')])
            ->add('submit', 'submit', ['label' => 'Принять'])
            ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
