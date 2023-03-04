<?php

namespace App\Repositories\Interfaces;

interface ProductInterface
{
    public function find($id);

    public function findAll($filter);
}
