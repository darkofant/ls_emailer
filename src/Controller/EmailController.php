<?php
namespace App\Controller;

use App\Entity\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends AbstractController
{
    public function newMail()
    {
        return new Response(
            '<html><body>new email dialog</body></html>'
            );
    }
    
    public function createMail(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $mail = new Mail();
        $mail -> setSubject('test');
        $mail -> setMessage('test');
        $mail -> setRecipientId(1);
        $mail -> setSenderId(2);
        $entityManager->persist($mail);
        $entityManager->flush();
        return new Response('Saved new mail with id '.$mail->getId());
        
    }
    
    public function reply()
    {
        
        return new Response(
            '<html><body>new email dialog</body></html>'
            );
    }
    
    public function show()
    {
 
        return new Response(
            '<html><body>view email dialog</body></html>'
            );
    }
    
    public function inbox()
    {
        return new Response(
            '<html><body>
                Inbox:
                <table class="data" border="1">
                  <tr>
                    <th>Datum/Uhrzeit</th>
                    <th>Absender</th>
                    <th>Betreff</th>
                    <th>Platzhalter</th>
                  </tr>
                  <tr>
                    <td>Entry First Line 1</td>
                    <td>Entry First Line 2</td>
                    <td>Entry First Line 3</td>
                    <td>Entry First Line 4</td>
                  </tr>
                  <tr>
                    <td>Entry Line 1</td>
                    <td>Entry Line 2</td>
                    <td>Entry Line 3</td>
                    <td>Entry Line 4</td>
                  </tr>
                  <tr>
                    <td>Entry Last Line 1</td>
                    <td>Entry Last Line 2</td>
                    <td>Entry Last Line 3</td>
                    <td>Entry Last Line 4</td>
                  </tr>
                </table>
            </body></html>'
            );
    }
    
    public function outbox()
    {
        return new Response(
            '<html><body>
                Inbox:
                <table class="data" border="1">
                  <tr>
                    <th>Datum/Uhrzeit</th>
                    <th>Absender</th>
                    <th>Betreff</th>     
                    <th>Platzhalter</th>
                  </tr>
                  <tr>
                    <td>Entry First Line 1</td>
                    <td>Entry First Line 2</td>
                    <td>Entry First Line 3</td>
                    <td>Entry First Line 4</td>
                  </tr>
                  <tr>
                    <td>Entry Line 1</td>
                    <td>Entry Line 2</td>
                    <td>Entry Line 3</td>
                    <td>Entry Line 4</td>
                  </tr>
                  <tr>
                    <td>Entry Last Line 1</td>
                    <td>Entry Last Line 2</td>
                    <td>Entry Last Line 3</td>
                    <td>Entry Last Line 4</td>
                  </tr>
                </table>
            </body></html>'
            );
    }
}