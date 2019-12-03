<?php

namespace App\Model;

class HeroesManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'heroes';
    const MAX_HEALTH = [null, 130, 80, 100];

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return string
     */
    public function resetHeroes():string
    {
        // prepared request
        $statement = $this->pdo->exec("UPDATE $this->table SET health = 130, attack = 150, gold = 20 WHERE id = 1");
        $statement2 = $this->pdo->exec("UPDATE $this->table SET health = 80, attack = 200, gold = 20 WHERE id = 2");
        $statement3 = $this->pdo->exec("UPDATE $this->table SET health = 100, attack = 165, gold = 40 WHERE id = 3");
        return $statement.$statement2.$statement3;
    }

    public function getCurrentHealth($idHero)
    {
        $statement = $this->pdo->prepare("SELECT health FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $idHero, \PDO::PARAM_INT);
        $statement->execute();
        $hero = $statement->fetch();
        $health = intval($hero['health']);
        return $health;
    }

    public function getHeroAttack($idHero)
    {
        $statement = $this->pdo->prepare("select heroes.attack from heroes where heroes.id=:idHero");
        $statement->bindValue('idHero', $idHero, \PDO::PARAM_INT);
        $statement->execute();
        $hero = $statement->fetch();
        $attack = intval($hero['attack']);

        return $attack;
    }

    public function setHealthFromPotion($idHero)
    {
        $potionsManager = new InventoryManager();
        $heroManager = new HeroesManager();
        //get the health of the hero
        $heroCurrentHealth = $heroManager->getCurrentHealth($idHero);
        //get the MAX health of the hero
        $heroMaxHealth = self::MAX_HEALTH[$idHero];
        //get the regen value of potion
        $potionRegen = $potionsManager->getPotionRegen($idHero);
        if (($heroCurrentHealth + $potionRegen) > $heroMaxHealth) {
            $newHealth = $heroMaxHealth;
        } else {
            $newHealth = $heroCurrentHealth+$potionRegen;
        }
        $statement = $this->pdo->prepare("UPDATE $this->table SET health = :newHealth WHERE id = :id");
        $statement->bindValue('id', $idHero, \PDO::PARAM_INT);
        $statement->bindValue('newHealth', $newHealth, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function setHealthFromAttack($idHero, $value)
    {
        $heroManager = new HeroesManager();
        //get the health of the hero
        $heroCurrentHealth = $heroManager->getCurrentHealth($idHero);
        $newHealth = $heroCurrentHealth-$value;
        $statement = $this->pdo->prepare("UPDATE $this->table SET health = :newHealth WHERE id = :id");
        $statement->bindValue('id', $idHero, \PDO::PARAM_INT);
        $statement->bindValue('newHealth', $newHealth, \PDO::PARAM_INT);
        $statement->execute();
    }
}
