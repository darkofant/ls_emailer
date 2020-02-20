<?php
namespace App\Controller;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends AbstractController
{
    public function createAccount(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $account = new Account();
        $account -> setEmailAdress('test@adresse.de');
        $account -> setName('tester');
        $entityManager->persist($account);
        $entityManager->flush();
        return new Response('Saved new mail with id '.$account->getId());
    }
}