<?php


namespace App\Core\Application\Query\Auth\GetToken;


use App\Core\Domain\Model\User\UserRepositoryInterface;
use App\Core\Domain\ValueObject\HashedPassword;
use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Exception\InvalidInputDataException;
use Doctrine\ORM\NonUniqueResultException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class GetTokenQueryHandler implements QueryHandlerInterface
{
    protected UserRepositoryInterface $userRepository;

    protected JWTTokenManagerInterface $JWTTokenManager;

    /**
     * CreateTokenCommandHandler constructor.
     * @param UserRepositoryInterface $userRepository
     * @param JWTTokenManagerInterface $JWTTokenManager
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                JWTTokenManagerInterface $JWTTokenManager)
    {
        $this->userRepository = $userRepository;
        $this->JWTTokenManager = $JWTTokenManager;
    }

    /**
     * @param GetTokenQuery $query
     * @return string
     * @throws InvalidInputDataException
     * @throws NonUniqueResultException
     */
    public function __invoke(GetTokenQuery $query) : string {
        $user = $this->userRepository->findOneByEmail($query->getEmail());

        if ($user === null) {
            throw new InvalidInputDataException('Login error: Invalid credentials');
        }

        if ($this->matchPassword($user->getPassword(), $query->getPlainPassword())) {
            throw new InvalidInputDataException('Login error: Invalid credentials');
        }

        return $this->JWTTokenManager->create($user);
    }

    /**
     * @param string $userPassword
     * @param string $plainPassword
     * @return bool
     */
    protected function matchPassword(string $userPassword, string $plainPassword) : bool {
        return $userPassword == HashedPassword::encode($plainPassword);
    }
}