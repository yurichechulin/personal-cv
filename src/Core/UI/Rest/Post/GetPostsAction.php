<?php


namespace App\Core\UI\Rest\Post;

use App\Core\Application\Query\Post\GetPosts\GetPostsQuery;
use App\Shared\Application\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GetPostsAction
{
    protected QueryBusInterface $queryBus;

    protected NormalizerInterface $normalizer;

    /**
     * GetPostsAction constructor.
     * @param QueryBusInterface $queryBus
     * @param NormalizerInterface $normalizer
     */
    public function __construct(QueryBusInterface $queryBus, NormalizerInterface $normalizer)
    {
        $this->queryBus = $queryBus;
        $this->normalizer = $normalizer;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/posts", name="posts", methods={"GET"})
     */
    public function __invoke(Request $request) : Response {
        $query = new GetPostsQuery();
        $data = $this->queryBus->ask($query);
        return new JsonResponse($this->normalizer->normalize($data), Response::HTTP_OK);
    }
}