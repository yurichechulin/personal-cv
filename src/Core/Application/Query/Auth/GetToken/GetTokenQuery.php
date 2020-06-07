<?php


namespace App\Core\Application\Query\Auth\GetToken;


use App\Shared\Application\Query\QueryInterface;

class GetTokenQuery implements QueryInterface
{
    protected string $email;

    protected string $plainPassword;

    /**
     * GetTokenQuery constructor.
     * @param string $email
     * @param string $plainPassword
     */
    public function __construct(string $email, string $plainPassword)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
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
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }
}