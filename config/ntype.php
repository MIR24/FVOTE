<?php

return [
    'name' => [
        1 => 'Сюжет',
        2 => 'Лонгрид',
        3 => 'Журналист',
        4 => 'Продюсер',
    ],

    'view' => [
        1 => 'user.datatables.worksByNomination',
        2 => 'user.datatables.worksByNominationLongread',
        3 => 'user.datatables.worksByNominationJournalist',
        4 => 'user.datatables.worksByNominationProducer',
    ],

    'viewAdmin' => [
        1 => 'admin.datatables.worksByNomination',
        2 => 'admin.datatables.worksByNominationLongread',
        3 => 'admin.datatables.worksByNominationJournalist',
        4 => 'admin.datatables.worksByNominationProducer',
    ],

    'form' => [
        1 => 'App\Forms\WorkForm',
        2 => 'App\Forms\WorkFormLongread',
        3 => 'App\Forms\WorkFormJournalist',
        4 => 'App\Forms\WorkFormProducer',
    ],

];
