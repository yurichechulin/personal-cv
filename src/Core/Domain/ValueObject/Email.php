<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Shared\Domain\Service\Assert\Assert;

class Email
{
    private string $email;

    /**
     * Email constructor.
     * @param string $email
     */
    private function __construct(string $email)
    {
        $this->email = $email;
    }

    public static function fromString(string $email) : self {
        Assert::email($email, "Поле должно быть email-ом");
        return new self($email);
    }

    /**
     * @return string
     */
    public function toString() : string {
        return $this->email;
    }

    /**
     * @return string
     */
    public function __toString() : string {
        return $this->email;
    }




}