<?php


namespace App\Core\Ports\Rest\Post;

use App\Core\Application\Query\Post\GetPosts\GetPostsQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class GetPostsAction
{
    use HandleTrait;

    private NormalizerInterface $normalizer;

    /**
     * GetPostsAction constructor.
     * @param MessageBusInterface $messageBus
     * @param NormalizerInterface $normalizer
     */
    public function __construct(MessageBusInterface $messageBus, NormalizerInterface $normalizer)
    {
        $this->messageBus = $messageBus;
        $this->normalizer = $normalizer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/posts", name="posts", methods={"GET"})
     */
    public function __invoke(Request $request) : Response {
        $query = new GetPostsQuery();
        $data = $this->handle($query);
        return new JsonResponse($this->normalizer->normalize($data), Response::HTTP_OK);
    }
}