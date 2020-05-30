<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Shared\Domain\Service\Assert\Assert;
use RuntimeException;

final class HashedPassword
{
    private string $hashedPassword;

    private function __construct(string $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * @param string $password
     * @return static
     */
    public static function encode(string $password) : self
    {
        Assert::minLength($password, 6, "Пароль должен быть не меньше 6 символов");
        return new self(self::getHash($password));
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verify(string $password) : bool {
        return password_verify($password, $this->hashedPassword);
    }

    /**
     * @return string
     */
    public function toString() : string {
        return $this->hashedPassword;
    }

    /**
     * @return string
     */
    public function __toString() : string {
        return $this->hashedPassword;
    }

    /**
     * @param string $password
     * @return string
     */
    private static function getHash(string $password) : string {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if (is_bool($hashedPassword)) {
            throw new RuntimeException('Server error hashing password');
        }

        return $hashedPassword;
    }
}