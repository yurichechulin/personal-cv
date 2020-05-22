<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller\User;

use App\Core\Application\Command\User\CreateUser\CreateUserCommand;
use App\Core\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterUserController extends CommandController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/users", name="add_user", methods={"POST"})
     */
    public function __invoke(Request $request) : Response {
        $command = new CreateUserCommand($request->request->get("email"), $request->request->get("name"), $request->request->get("password"));
        $this->handle($command);
        return new JsonResponse(["message" => "Пользователь создан"], JsonResponse::HTTP_CREATED);
    }
}