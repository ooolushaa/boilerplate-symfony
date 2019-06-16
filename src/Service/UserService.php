<?php

namespace App\Service;

use App\DTO\Request\RegistrationRequestDTO;
use App\Entity\User;
use App\Exception\PasswordDoesNotMatchException;
use App\Exception\UserWithSameEmailWasAlreadyRegisteredException;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserService
{
    private $userRepository;
    private $encoder;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }

    public function register(RegistrationRequestDTO $registrationRequestDTO): User
    {
        if ($this->userRepository->findOneByEmail($registrationRequestDTO->getEmail())) {
            throw new UserWithSameEmailWasAlreadyRegisteredException();
        }

        if ($registrationRequestDTO->getPassword() !== $registrationRequestDTO->getPasswordConfirm()) {
            throw new PasswordDoesNotMatchException();
        }

        $user = new User();
        $user->setName($registrationRequestDTO->getName());
        $user->setEmail($registrationRequestDTO->getEmail());
        $user->setPassword($this->encoder->encodePassword($user, $registrationRequestDTO->getPassword()));

        $this->userRepository->save($user);

        return $user;
    }
}
