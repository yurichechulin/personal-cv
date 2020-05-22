<?php

declare(strict_types=1);

namespace App\Core\Application\Command\User\CreateUser;


use App\Shared\Application\Command\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    private string $email;

    private string $name;

    private string $password;

    /**
     * CreateUserCommand constructor.
     * @param string $email
     * @param string $name
     * @param string $password
     */
    public function __construct(string $email, string $name, string $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}