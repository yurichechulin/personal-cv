<?php


namespace App\Core\UI\Rest\Controller\Auth;


use App\Core\Application\Command\Auth\CreateToken\CreateTokenCommand;
use App\Core\Application\Query\Auth\GetToken\GetTokenQuery;
use App\Core\UI\Rest\Controller\CommandQueryController;
use App\Shared\Domain\Service\Assert\Assert;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserController extends CommandQueryController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request) : Response
    {
        $email = $request->get("email");
        $plainPassword = $request->get("password");

        Assert::email($email, "Поле email не соответствует типу");
        Assert::notEmpty($plainPassword, "Поле password не должно быть пустым");

        $this->handle(new CreateTokenCommand($email, $plainPassword));

        $token = $this->ask(new GetTokenQuery());

        return new JsonResponse($token, Response::HTTP_OK);
    }
}