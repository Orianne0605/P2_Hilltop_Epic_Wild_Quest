<?php

namespace App\Model;

class EnigmasManager extends AbstractManager
{
    const TABLE = 'stories';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
