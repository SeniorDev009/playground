<?php

namespace Bidcoz\Bundle\CoreBundle\Entity;

use JMS\Serializer\Annotation as Serialize;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serialize\ExclusionPolicy("all")
 */
class User
{
    /**
     * @Serialize\Expose
     * @Serialize\Groups({"Default", "API"})
     */
    protected $id;

    /**
     * @Assert\NotBlank(groups={"Registration", "Profile"})
     * @Assert\Length(min=1, max=50, groups={"Registration", "Profile"})
     * @Serialize\Expose
     * @Serialize\SerializedName("firstName")
     */
    protected $firstName;

    /**
     * @Assert\NotBlank(groups={"Registration", "Profile"})
     * @Assert\Length(min=1, max=50)
     * @Serialize\Expose
     * @Serialize\SerializedName("lastName")
     */
    protected $lastName;

    /**
     * @Assert\Valid
     * @Serialize\Expose
     */
    protected $address;

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @Serialize\VirtualProperty
     * @Serialize\SerializedName("name")
     * @Serialize\Groups({"Default", "API"})
     */
    public function getName()
    {
        $name = $this->firstName;

        if ($this->lastName) {
            $name .= ' '.$this->lastName;
        }

        return $name;
    }

    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }
}
