<?php

namespace App\DTO\Request;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

final class RegistrationRequestDTO implements RequestDTOInterface
{
    /**
     *
     * @Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     * )
     */
    public $name;

    /**
     *
     * @Type("string")
     * @Assert\Email
     * @Assert\NotBlank
     */
    public $email;

    /**
     * @Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     * )
     */
    public $password;

    /**
     * @Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     * )
     */
    public $passwordConfirm;

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirm(): string
    {
        return $this->passwordConfirm;
    }

}
