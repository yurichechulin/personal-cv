<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller\User;

use App\Core\Application\Command\User\CreateUser\CreateUserCommand;
use App\Core\UI\Rest\Controller\CommandController;
use App\Shared\Domain\Service\Assert\Assert;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends CommandController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/signup", name="create_user", methods={"POST"})
     */
    public function __invoke(Request $request) : Response {
        $uuid = $request->get("uuid");
        $email = $request->get("email");
        $name = $request->get("name");
        $password = $request->get("password");

        Assert::uuid($uuid, "Поле uuid не соответствует типу");
        Assert::email($email, "Поле email не соответствует типу");
        Assert::notEmpty($name, "Поле name не должно быть пустым");
        Assert::notEmpty($password, "Поле password не должно быть пустым");

        $this->handle(new CreateUserCommand($uuid, $email, $name, $password));

        return new JsonResponse(["message" => "Пользователь создан"], JsonResponse::HTTP_CREATED);
    }
}