<?php
namespace App\Controller;

use App\Model\HeroesManager;
use App\Model\InventoryManager;
use App\Model\LocationManager;
use App\Model\StoryManager;
use App\Model\EnigmasManager;

class EnigmaController extends AbstractController
{
    const ENIGMA1_ANSWER = "viens me voir";
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
    public function enigma1($id, $idHero)
    {
        //calling InventoryManager
        $itemsManager = new InventoryManager();
        //fetch weapons
        $weapons = $itemsManager->selectWeapons($idHero);
        //fetch spells
        $spells = $itemsManager->selectSpells($idHero);
        //fetch potions
        $potions = $itemsManager->selectPotions($idHero);
        $enigmasManager = new EnigmasManager();
        $enigma = $enigmasManager->selectOneById($id);
        $storiesManager = new StoryManager();
        $story = $storiesManager->selectOneById($id);
        $heroesManager = new HeroesManager();
        $heroes = $heroesManager->selectAll();
        //display locations
        $locationId = $story['locations_id'];
        $locationsManager = new LocationManager();
        $location=$locationsManager->selectOneById($locationId);
        return $this->twig->render('Enigmas/enigma1.html.twig', [
            'potions' => $potions,
            'weapons' => $weapons,
            'spells' => $spells,
            'story' => $story,
            'enigma' => $enigma,
            'heroes'=>$heroes,
            'location' =>$location,
            'picture'=> $location['picture'],
            'path'=>$this->requestPath()
        ]);
    }
    public function sendAnswer($id, $idHero): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $answer = $_POST['answer'];
            $answer = strtolower($answer);
            $_SESSION["answer1"] ++;
            if ($answer != self::ENIGMA1_ANSWER) {
                if ($_SESSION["answer1"] >= 3) {
                    header('Location: ../../../quest/end/4');
                } else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return true;
                }
            } else {
                $id += 2;
                header("Location: ../../../quest/story/$id/$idHero");
                return true;
            }
        }
        return true;
    }
}
