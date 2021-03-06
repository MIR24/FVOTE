<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Nomination;

class WorkFormLongread extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => 'Месяц: Заголовок', 'rules' => 'required|string|max:255'])
            ->add('url', 'text', ['label' => 'Ссылка', 'rules' => 'required|string|max:255'])
            ->add('filial', 'text', ['label' => 'Филиал', 'rules' => 'required|string|max:255'])
            ->add('correspondent', 'text', ['label' => 'Автор текста', 'rules' => 'required|string|max:255'])
            ->add('operator', 'text', ['label' => 'Автор фото', 'rules' => 'required|string|max:255'])
            ->add('nomination', 'hidden', ['value' => $this->getData('nomination')])
            ->add('submit', 'submit', ['label' => 'Принять'])
            ->add('reset', 'reset', ['label' => 'Очистить']);
    }
}
