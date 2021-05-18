<?php

namespace Bidcoz\Bundle\FrontendBundle\Controller;

use Bidcoz\Bundle\CoreBundle\Controller\CoreController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/search")
 */
class SearchController extends CoreController
{
    /**
     * @Route("", name="search")
     */
    public function searchAction(Request $request)
    {
        $query = $request->query->get('q');

        $data = [
            'q' => $query,
        ];

        if ($query && strlen($query) > 2) {
            $data['searchOrganizations'] = ['foo', 'bar'];
        } else {
            $data['error'] = 'Your search must be greater than 2 characteres';
        }

        return $this->render('BidcozFrontendBundle:Search:index.html.twig', $data);
    }
}
