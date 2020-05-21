<?php

declare(strict_types=1);

namespace App\Core\Application\Query\Post\GetPosts;

use App\Core\Application\Query\Post\DTO\PostDTO;
use App\Core\Domain\Model\Post\PostRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

final class GetPostsQueryHandler implements QueryHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    /**
     * GetPostsQueryHandler constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    /**
     * @param GetPostsQuery $query
     * @return PostDTO[]
     */
    public function __invoke(GetPostsQuery $query) : array
    {
        $posts = $this->postRepository->findAll();

        $postsDTOs = [];

        foreach ($posts as $post) {
            $postsDTOs[] = PostDTO::fromEntity($post);
        }

        return $postsDTOs;
    }

}