<?php

declare(strict_types=1);

namespace App\Core\Domain\ValueObject;

use App\Shared\Domain\Service\Assert\Assert;

use const PASSWORD_BCRYPT;

final class HashedPassword
{
    private string $hashedPassword;

    public const COST = 12;

    private function __construct(string $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * @param string $plainPassword
     * @return static
     */
    public static function encode(string $plainPassword): self
    {
        return new self(self::hash($plainPassword));
    }

    /**
     * @param string $hashedPassword
     * @return static
     */
    public static function fromHash(string $hashedPassword): self
    {
        return new self($hashedPassword);
    }

    public function match(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }

    /**
     * @param string $plainPassword
     * @return string
     */
    private static function hash(string $plainPassword): string
    {
        Assert::minLength($plainPassword, 6, 'Min 6 characters password');

        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => self::COST]);

        if (is_bool($hashedPassword)) {
            throw new \RuntimeException('Server error hashing password');
        }

        return (string)$hashedPassword;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->hashedPassword;
    }
}
