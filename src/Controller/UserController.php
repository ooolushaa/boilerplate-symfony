<?php

namespace App\Controller;

use App\DTO\Request\RegistrationRequestDTO;
use App\Service\UserService;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * TODO Move to AuthController
     * @Route("/registration", name="registration", methods={"POST"})
     */
    public function registrationAction(
        RegistrationRequestDTO $registrationRequestDTO,
        UserService $userService
    ) {
        $user = $userService->register($registrationRequestDTO);

        return JsonResponse::create($user);
    }

    /**
     * @Route("/logged-user", name="get_logged_gser", methods={"GET"})
     */
    public function getLoggedUserAction(SerializerInterface $serializer)
    {
        return JsonResponse::create($this->getUser());
    }
}
