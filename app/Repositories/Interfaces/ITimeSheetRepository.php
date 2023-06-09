<?php

namespace App\Repositories\Interfaces;

interface ITimeSheetRepository
{
    public function list();

    /**
     * Create timeSheet
     * @param $attributes
     * @return mixed
     */
    public function store(array $attributes);

    public function calendar();
}
