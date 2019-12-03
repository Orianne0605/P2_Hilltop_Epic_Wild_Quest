<?php


namespace App\Model;

class CreaturesManager extends AbstractManager
{
    const TABLE = 'creatures';
    const MAX_HEALTH = [null, 130, 170];

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function resetCreatures():string
    {
        // prepared request
        $statement = $this->pdo->exec("UPDATE $this->table SET health = 130 where id = 1");
        $statement2 = $this->pdo->exec("UPDATE $this->table SET health = 170 where id = 2");
        return $statement.$statement2;
    }

    public function getCreatureAttack($idCreature)
    {
        $statement = $this->pdo->prepare("select creatures.attack from creatures
    join stories s on creatures.id = s.creatures_id where creatures.id=:idCreature");
        $statement->bindValue('idCreature', $idCreature, \PDO::PARAM_INT);
        $statement->execute();
        $creature = $statement->fetch();
        $attack = intval($creature['attack']);

        return $attack;
    }

    public function getCurrentHealth($idCreature)
    {
        $statement = $this->pdo->prepare("SELECT health FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $idCreature, \PDO::PARAM_INT);
        $statement->execute();
        $creature = $statement->fetch();
        $health = intval($creature['health']);
        return $health;
    }

    public function setHealthFromAttack($idCreature, $value)
    {
        $creatureManager = new CreaturesManager();
        //get the health of the creature
        $currentHealth = $creatureManager->getCurrentHealth($idCreature);
        $newHealth = $currentHealth-$value;
        $statement = $this->pdo->prepare("UPDATE $this->table SET health = :newHealth WHERE id = :id");
        $statement->bindValue('id', $idCreature, \PDO::PARAM_INT);
        $statement->bindValue('newHealth', $newHealth, \PDO::PARAM_INT);
        $statement->execute();
    }
}
