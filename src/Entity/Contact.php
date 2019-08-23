<?php
/**
 * Created by PhpStorm.
 * User: mha
 * Date: 26/11/18
 * Time: 21:39
 */

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


class Contact
{

    /**
     * @var|null
     * @Assert\Length(min="2",max="100")
     * @Assert\NotBlank()
     */
    private $firstname;


    /**
     * @var|null
     * @Assert\Length(min="2",max="100")
     * @Assert\NotBlank()
     */
    private $lastname;


    /**
     * @var|null
     * @Assert\NotBlank()
     */
    private $phone;

    /**-
     * @var|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var|null
     * @Assert\Length(min="10",max="100")
     */
    private $message;

    /**
     * @var Property|null
     */
    private $property;

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return Contact
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return Contact
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return Contact
     */
    public function setPhone($phone):self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Contact
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return Contact
     */
    public function setMessage(?string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Property|null
     */
    public function getProperty(): ?Property
    {
        return $this->property;
    }

    /**
     * @param Property|null $property
     * @return Contact
     */
    public function setProperty(?Property $property): Contact
    {
        $this->property = $property;
        return $this;
    }




}