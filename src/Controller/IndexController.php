<?php 

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class IndexController extends AbstractController
{
    /**
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"}, name="index")
     * @return Response
     */
    private $session;
    
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    
    public function indexAction(): Response
    {
        $this->session->set('account_id', 1);
        return $this->render('base.html.twig', []);
    }
}