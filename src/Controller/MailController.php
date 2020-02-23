<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class MailController extends AbstractController
{

    /** @var EntityManagerInterface */
    private $em;
    
    /** @var SerializerInterface */
    private $serializer;


    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }
    
    /**
     * @throws BadRequestHttpException
     */

    public function createAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $sender = $data['sender'];
        $recipients = $data['recipients'];
        $subject = $data['subject'];
        $text = $data['text'];
        $datetime = $_SERVER['REQUEST_TIME'];
       
        $outgoingMail = new Mail();
        $outgoingMail -> setSender($sender);
        $outgoingMail -> setRecipients($recipients);
        $outgoingMail -> setSubject($subject);
        $outgoingMail -> setText($text); 
        $outgoingMail -> setDatetime($datetime); 
        $outgoingMail -> setNew(false); 
        $outgoingMail -> setType(1); 
        
        $this->em->persist($outgoingMail);
        $this->em->flush();
        $data = $this->serializer->serialize($outgoingMail, JsonEncoder::FORMAT);
        
        return new JsonResponse($data, Response::HTTP_CREATED, [], true);
    }

    public function inboxAction(): JsonResponse
    {
        $mails = $this->em->getRepository(Mail::class)->findBy(['type' => 0], ['datetime' => 'DESC']);
        $data = $this->serializer->serialize($mails, JsonEncoder::FORMAT);
        
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
    
    public function outboxAction(): JsonResponse
    {
        $mails = $this->em->getRepository(Mail::class)->findBy(['type' => 1], ['datetime' => 'DESC']);
        $data = $this->serializer->serialize($mails, JsonEncoder::FORMAT);
        
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }


    public function newMail()
    {
     
    }
    
    public function replyMail()
    {
     
    }
    
    public function sendMail(): Response
    {
        
    }
    
    public function show()
    {
 
    }
    
}