<?php

namespace Bidcoz\Bundle\CoreBundle\Command;

use Bidcoz\Bundle\CoreBundle\BidcozCoreServices;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

abstract class CoreCommand extends ContainerAwareCommand
{
    use BidcozCoreServices;

    protected function get($service)
    {
        return $this->getContainer()->get($service);
    }

    protected function getContainerParameter(string $parameter)
    {
        return $this->getContainer()->getParameter($parameter);
    }
}
