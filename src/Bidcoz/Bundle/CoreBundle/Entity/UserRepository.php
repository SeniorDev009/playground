<?php

namespace Bidcoz\Bundle\CoreBundle\Entity;

class UserRepository
{
    public function getUser() : User
    {
        $user = new User();
        $user->setFirstName('Foo');
        $user->setLastName('Bar');

        $address = new Address();
        $address->setAddress1('123 ABC Street');

        $user->setAddress($address);

        return $user;
    }
}
