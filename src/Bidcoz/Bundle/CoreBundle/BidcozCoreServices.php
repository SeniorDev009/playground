<?php

namespace Bidcoz\Bundle\CoreBundle;

trait BidcozCoreServices
{
    protected function getSerializer()
    {
        return $this->get('jms_serializer');
    }

    protected function getRepository(string $class)
    {
        // This is a hack for demonstration purposes.
        $repoClass = sprintf('%sRepository', $class);
        return new $repoClass;
    }

    protected function getSession()
    {
        return $this->get('session');
    }

    protected function getRouter()
    {
        return $this->get('router');
    }

    protected function getLogger()
    {
        return $this->get('logger');
    }

    protected function getValidator()
    {
        return $this->get('validator');
    }

    protected function getFormFactory()
    {
        return $this->get('form.factory');
    }

    protected function getLoggedInUserProvider()
    {
        return $this->get('user_provider');
    }

    protected function getLoggedInUser()
    {
        return $this->getLoggedInUserProvider()->getLoggedInUser();
    }

    protected function getContainerParameter(string $parameter)
    {
        return $this->getContainer()->getParameter($parameter);
    }

    protected function getRequest(): ? Request
    {
        return $this->get('request_stack')
            ->getCurrentRequest();
    }
}
