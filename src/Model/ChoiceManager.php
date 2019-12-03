<?php

namespace App\Model;

class ChoiceManager extends AbstractManager
{
    const TABLE = 'choices';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    public function selectResponse(int $id)
    {
        $myquery =  $this->pdo->prepare('select * from choices
                    join stories s on choices.stories_id = s.id where s.id = :id;');
        $myquery->bindValue('id', $id, \PDO::PARAM_INT);
        $myquery->execute();
        return $myquery->fetchAll();
    }
}
