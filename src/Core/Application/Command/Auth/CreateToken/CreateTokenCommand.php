<?php


namespace App\Core\Application\Command\Auth\CreateToken;


use App\Shared\Application\Command\CommandInterface;

class CreateTokenCommand implements CommandInterface
{
    protected string $email;

    protected string $plainPassword;

    /**
     * CreateAuthTokenCommand constructor.
     * @param string $email
     * @param string $plainPassword
     */
    public function __construct(string $email, string $plainPassword)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }
}