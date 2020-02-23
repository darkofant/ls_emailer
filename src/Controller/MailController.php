<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Mail;
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

class MailController extends AbstractController
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

    public function createAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $sender = $data['sender'];
        $recipients = $data['recipients'];
        $subject = $data['subject'];
        $text = $data['text'];
        $datetime = $_SERVER['REQUEST_TIME'];
        
        $r_account = $this->em->getRepository(Account::class)->findBy(['email_address' => $recipients])[0];   
        
        
        if ($r_account) {
            
            $outgoingMail = new Mail();
            $outgoingMail -> setSender($sender);
            $outgoingMail -> setRecipients($recipients);
            $outgoingMail -> setSubject($subject);
            $outgoingMail -> setText($text); 
            $outgoingMail -> setDatetime($datetime); 
            $outgoingMail -> setNew(false); 
            $outgoingMail -> setType(1); 
            $outgoingMail -> setAccountId($this->account_id);
            
            $this->em->persist($outgoingMail);
            $this->em->flush();
            
            $mail = new Mail();
            $mail -> setSender($sender);
            $mail -> setRecipients($recipients);
            $mail -> setSubject($subject);
            $mail -> setText($text);
            $mail -> setDatetime($datetime);
            $mail -> setNew(true);
            $mail -> setType(0);
            
            $mail -> setAccountId($r_account.id);
            
            $this->em->persist($mail);
            $this->em->flush();
            
            
            $data = $this->serializer->serialize($outgoingMail, JsonEncoder::FORMAT);
        
            return new JsonResponse($data, Response::HTTP_CREATED, [], true);
        }else {
            return new JsonResponse('', Response::HTTP_BAD_REQUEST, [], true);
        }
    }

    public function inboxAction(): JsonResponse
    {
        $mails = $this->em->getRepository(Mail::class)->findBy(['type' => 0, 'account_id' => $this->account_id], ['datetime' => 'DESC']);
        $data = $this->serializer->serialize($mails, JsonEncoder::FORMAT);
        
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
    
    public function outboxAction(): JsonResponse
    {
        $mails = $this->em->getRepository(Mail::class)->findBy(['type' => 1, 'account_id' => $this->account_id], ['datetime' => 'DESC']);
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