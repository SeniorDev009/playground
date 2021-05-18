<?php

namespace Bidcoz\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Value object for a person.
 *
 * @ORM\Embeddable
 */
class Person
{
    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column(name="fname", type="string", length=100, nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(name="lname", type="string", length=100, nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\ManyToOne(targetEntity="UserTitle")
     * @ORM\JoinColumn(name="user_title_id", referencedColumnName="user_title_id")
     */
    protected $title;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }
}
