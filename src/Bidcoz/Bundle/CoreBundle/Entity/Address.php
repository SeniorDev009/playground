<?php

namespace Bidcoz\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Value object for an address.
 *
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Assert\Length(max=255, groups={"Profile"})
     */
    protected $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Assert\Length(max=128, groups={"Profile"})
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Assert\Regex(pattern="/\d{5}/", groups={"Profile"})
     */
    protected $zip;

    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function isComplete(): bool
    {
        return (bool) $this->address1 && $this->city && $this->state && $this->zip;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s %s; %s %s %s',
            $this->address1,
            $this->address2,
            $this->city,
            $this->state,
            $this->zip
        );
    }
}
