<?php

namespace Bidcoz\Bundle\FrontendBundle\Controller;

use Bidcoz\Bundle\CoreBundle\Controller\CoreController;
use Bidcoz\Bundle\CoreBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user-json")
 */
class UserJsonController extends CoreController
{
    /**
     * @Route("", name="user_json")
     */
    public function userJsonAction(Request $request)
    {
        $user = $this->getRepository(User::class)->getUser();
        $data = $this->getSerializer()->serialize($user, 'json');

        return $this->returnJson($data, true);
    }
}
