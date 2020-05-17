<?php


namespace App\Core\Domain\Model\Post;


interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function findAll() : array;

    /**
     * @param Post $post
     * @return bool
     */
    public function save(Post $post) : bool;
}