<?php


namespace App\Controller;

use App\Model\CreaturesManager;
use App\Model\HeroesManager;
use App\Model\InventoryManager;

class HomeController extends AbstractController
{
    public function index()
    {
        $_SESSION["answer1"]=0;
        return $this->twig->render('Begin/begin.html.twig');
    }

    public function choose()
    {
        $heroesManager = new HeroesManager();
        $creatureManager = new CreaturesManager();
        // reset stats
        $heroesManager->resetHeroes();
        $creatureManager->resetCreatures();
        $heroes = $heroesManager->selectAll();
        return $this->twig->render('Begin/chooseHero.html.twig', [
            'heroes' => $heroes
        ]);
    }
}
