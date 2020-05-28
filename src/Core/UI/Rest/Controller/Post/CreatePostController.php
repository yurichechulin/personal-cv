<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller\Post;

use App\Core\Application\Command\Post\CreatePost\CreatePostCommand;
use App\Core\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends CommandController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/api/posts", name="add_post", methods={"POST"})
     */
    public function __invoke(Request $request) : Response {
        $command = new CreatePostCommand(
            $request->request->get("name"),
            $request->request->get("description"));
        $this->handle($command);
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}