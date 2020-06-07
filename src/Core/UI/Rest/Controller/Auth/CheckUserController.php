<?php

declare(strict_types = 1);

namespace App\Core\UI\Rest\Controller\Auth;

use App\Core\Application\Query\Auth\GetToken\GetTokenQuery;
use App\Core\UI\Rest\Controller\QueryController;
use App\Shared\Domain\Service\Assert\Assert;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CheckUserController extends QueryController
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/api/login", name="create_token", methods={"POST"})
     */
    public function __invoke(Request $request) : Response
    {
        $email = $request->get("email");
        $plainPassword = $request->get("password");

        Assert::email($email, "Поле email не соответствует типу");
        Assert::notEmpty($plainPassword, "Поле password не должно быть пустым");

        $token = $this->ask(new GetTokenQuery($email, $plainPassword));

        return new JsonResponse($token, Response::HTTP_OK);
    }
}