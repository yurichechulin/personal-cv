<?php


namespace App\Core\UI\Rest\Post;

use App\Core\Application\Command\Post\CreatePost\CreatePostCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostAction
{
    protected CommandBusInterface $commandBus;

    /**
     * CreatePostAction constructor.
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/posts", name="add_post", methods={"POST"})
     */
    public function __invoke(Request $request) : Response {
        $command = new CreatePostCommand($request->request->get("name"), $request->request->get("description"));
        $this->commandBus->handle($command);
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}