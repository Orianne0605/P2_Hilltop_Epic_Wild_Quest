<?php


namespace App\Controller;

class BuyController extends AbstractController
{
    public function buyNow()
    {
        return $this->twig->render('Buy/buy.html.twig');
    }
}
