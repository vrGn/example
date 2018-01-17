<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ExampleForm
{
    /**
     * @Assert\NotBlank()
     */
    protected $last_name;

    /**
     * @Assert\NotBlank()
     */
    protected $first_name;

    /**
     * @Assert\NotBlank()
     */
    protected $middle_name;

    /**
     * @Assert\NotBlank()
     */
    protected $email_address;

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getMiddleName()
    {
        return $this->middle_name;
    }

    public function setMiddleName($middle_name)
    {
        $this->middle_name = $middle_name;
    }

    public function getEmailAddress()
    {
        return $this->email_address;
    }

    public function setEmailAddress($email_address)
    {
        $this->email_address = $email_address;
    }
}
