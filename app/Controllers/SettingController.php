<?php

namespace App\Controllers;

use App\Models\Migrations\CreateTable;

class SettingController
{
    public function install()
    {
        CreateTable::up();
        return 'Создание БД успешно завершено';
    }

    public function drop()
    {
        CreateTable::down();
        return 'Очистка БД успешна завершена';
    }
}