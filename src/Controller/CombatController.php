<?php

namespace App\Controller;

use App\Model\ChoiceManager;
use App\Model\CreaturesManager;
use App\Model\HeroesManager;
use App\Model\StoryManager;
use App\Model\InventoryManager;

class CombatController extends AbstractController
{

    public function requestPath()
    {
        $requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $scriptName = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($requestUri, $scriptName);
        if (empty($parts)) {
            return '/';
        }
        return $parts;
    }

    public function fight($idCreature, $idHero)
    {
        //calling InventoryManager
        $itemsManager = new InventoryManager();
        //fetch weapons
        $weapons = $itemsManager->selectWeapons($idHero);
        //fetch spells
        $spells = $itemsManager->selectSpells($idHero);
        //fetch potions
        $potions = $itemsManager->selectPotions($idHero);
        //calling HeroesManager
        $heroesManager = new HeroesManager();
        $heroes = $heroesManager->selectAll();
        $hero = $heroesManager->selectOneById($idHero);
        //calling CreaturesManager
        $creaturesManager = new CreaturesManager();
        $creature = $creaturesManager->selectOneById($idCreature);

        $heroHealth = $heroesManager->getCurrentHealth($idHero);
        $creatureHealth = $creaturesManager->getCurrentHealth($idCreature);
        if ($heroHealth <= 0) {
            header("Location: ../../../quest/end/8");
        } elseif ($creatureHealth <= 0) {
            header("Location: ../../../buy/buynow");
        } else {
            return $this->twig->render('Combat/combat.html.twig', [
                'potions' => $potions,
                'weapons' => $weapons,
                'spells' => $spells,
                'heroes' => $heroes,
                'hero' => $hero,
                'creature' => $creature,
                'heroMaxHealth' => HeroesManager::MAX_HEALTH[$idHero],
                'creatureMaxHealth' => CreaturesManager::MAX_HEALTH[$idCreature],
                'path' => $this->requestPath()
            ]);
        }
    }

    public function useWeapon($weaponName, $idHero, $idCreature)
    {
        $weaponsManager = new InventoryManager();
        //getting weapon ATTACK
        $weaponAttack = $weaponsManager->getWeaponAttack($weaponName, $idHero);

        $creatureManager = new CreaturesManager();
        //getting creature ATTACK
        $creatureAttack = $creatureManager->getCreatureAttack($idCreature);

        $heroManager = new HeroesManager();
        //getting hero ATTACK
        $heroAttack = $heroManager->getHeroAttack($idHero);

        // hero's damage formula
        $heroTotalAttack = $heroAttack+$weaponAttack;
        $min = intval(($heroTotalAttack*0.1));
        $max = intval(($heroTotalAttack*0.3));
        $heroDamage = rand($min, $max);
        //Creature takes damage
        $creatureManager->setHealthFromAttack($idCreature, $heroDamage);

        //Hero takes damage
        $heroManager->setHealthFromAttack($idHero, $creatureAttack);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
