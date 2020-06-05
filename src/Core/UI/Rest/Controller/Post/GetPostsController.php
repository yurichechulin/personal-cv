<?php

declare(strict_types=1);

namespace App\Core\UI\Rest\Controller\Post;

use App\Core\Application\Query\Post\GetPosts\GetPostsQuery;
use App\Core\UI\Rest\Controller\QueryController;
use App\Shared\Application\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GetPostsController extends QueryController
{
    protected NormalizerInterface $normalizer;

    /**
     * GetPostsAction constructor.
     * @param NormalizerInterface $normalizer
     * @param QueryBusInterface $queryBus
     */
    public function __construct(NormalizerInterface $normalizer, QueryBusInterface $queryBus)
    {
        parent::__construct($queryBus);
        $this->normalizer = $normalizer;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/api/posts", name="posts", methods={"GET"})
     */
    public function __invoke(Request $request) : Response
    {
        $query = new GetPostsQuery();
        $data = $this->queryBus->ask($query);
        return new JsonResponse($this->normalizer->normalize($data), Response::HTTP_OK);
    }
}