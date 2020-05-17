<?php


namespace App\Core\Infrastructure\Repository\Post;

use App\Core\Domain\Model\Post\Post;
use App\Core\Domain\Model\Post\PostRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PostRepository
 * @package App\Core\Infrastructure\Repository\Post
 */
class PostRepository implements PostRepositoryInterface
{
    private EntityManagerInterface $_em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

    /**
     * @return Post[]
     */
    public function findAll() : array
    {
        return $this->_em->getRepository(Post::class)->findAll();
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function save(Post $post) : bool {
        $this->_em->persist($post);
        $this->_em->flush();
        return true;
    }
}