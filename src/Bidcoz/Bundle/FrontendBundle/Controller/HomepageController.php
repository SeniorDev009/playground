<?php

namespace Bidcoz\Bundle\FrontendBundle\Controller;

use Bidcoz\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends CoreController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('BidcozFrontendBundle:Homepage:homepage.html.twig');
    }
}
