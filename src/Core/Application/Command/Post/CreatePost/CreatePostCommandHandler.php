<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Post\CreatePost;

use App\Core\Domain\Model\Post\Post;
use App\Core\Domain\Model\Post\PostRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreatePostCommandHandler implements CommandHandlerInterface
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

    public function __invoke(CreatePostCommand $command) : string
    {
        $post = new Post($command->getName(), $command->getDescription());

        $this->postRepository->save($post);

        return $post->getUuid();
    }
}