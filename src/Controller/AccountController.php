<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AccountController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;
    
    /** @var SerializerInterface */
    private $serializer;
    
    
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer, SessionInterface $session)
    {
        $this->em = $em;
        $this->serializer = $serializer;
        $this->session = $session;
        $this->account_id = $this->session->get('account_id');
    }
    
    /**
     * @throws BadRequestHttpException
     */
    
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
    
    public function accountAction(): JsonResponse
    {
        $account = $this->em->getRepository(Account::class)->find($this->account_id);
        $data = $this->serializer->serialize($account, JsonEncoder::FORMAT);
        
        
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}