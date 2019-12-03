<?php

namespace App\Model;

class StoryManager extends AbstractManager
{
    const TABLE = 'stories';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
