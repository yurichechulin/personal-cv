<?php


namespace App\Core\Infrastructure\Specification\User;


use App\Core\Domain\Exception\User\EmailAlreadyExistsException;
use App\Core\Domain\Model\User\UniqueUserSpecificationInterface;
use App\Core\Domain\Model\User\UserRepositoryInterface;
use App\Shared\Domain\Exception\UuidAlreadyExistsException;
use App\Shared\Domain\Specification\UniqueUuidSpecificationInterface;
use Doctrine\ORM\NonUniqueResultException;
use Ramsey\Uuid\UuidInterface;

class UniqueUserSpecification implements UniqueUserSpecificationInterface, UniqueUuidSpecificationInterface
{
    protected UserRepositoryInterface $userRepository;

    /**
     * UniqueUserSpecification constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UuidInterface $uuid
     * @param string $email
     * @return bool
     * @throws EmailAlreadyExistsException
     * @throws UuidAlreadyExistsException
     */
    public function isUserUnique(UuidInterface $uuid, string $email) : bool {
        return $this->isUuidUnique($uuid) && $this->isEmailUnique($email);
    }

    /**
     * @param string $email
     * @return bool
     * @throws EmailAlreadyExistsException
     */
    protected function isEmailUnique(string $email): bool
    {
        try {
            $this->checkIfUserExistsByEmail($email);
        } catch (NonUniqueResultException $exception) {
            throw new EmailAlreadyExistsException(sprintf("email '%s' not unique", $value));
        }

        return true;
    }

    /**
     * @param UuidInterface $uuid
     * @return bool
     * @throws UuidAlreadyExistsException
     */
    public function isUuidUnique(UuidInterface $uuid): bool
    {
        try {
            $this->checkIfUserExistsByUuid($uuid);
        } catch (NonUniqueResultException $exception) {
            throw new UuidAlreadyExistsException(sprintf("uuid '%s' not unique", $uuid));
        }

        return true;
    }

    /**
     * @param UuidInterface $uuid
     * @throws UuidAlreadyExistsException
     * @throws NonUniqueResultException
     */
    protected function checkIfUserExistsByUuid(UuidInterface $uuid) {
        if ($this->userRepository->findOneByUuid($uuid) !== null) {
            throw new UuidAlreadyExistsException(sprintf("uuid '%s' already exists", $uuid));
        }
    }

    /**
     * @param string $email
     * @throws EmailAlreadyExistsException
     * @throws NonUniqueResultException
     */
    protected function checkIfUserExistsByEmail(string $email) : void {
        if ($this->userRepository->findOneByEmail($email) !== null) {
            throw new EmailAlreadyExistsException(sprintf("email '%s' already exists", $email));
        }
    }
}