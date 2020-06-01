<?php


namespace App\Core\Application\Command\User\CreateUser;


use App\Core\Domain\Model\User\UniqueUserSpecificationInterface;
use App\Core\Domain\Model\User\User;
use App\Core\Domain\Model\User\UserRepositoryInterface;
use App\Core\Domain\ValueObject\HashedPassword;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    private UniqueUserSpecificationInterface $uniqueUserSpecificationInterface;

    /**
     * CreateUserCommandHandler constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UniqueUserSpecificationInterface $uniqueUserSpecificationInterface
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                UniqueUserSpecificationInterface $uniqueUserSpecificationInterface)
    {
        $this->userRepository = $userRepository;
        $this->uniqueUserSpecificationInterface = $uniqueUserSpecificationInterface;
    }


    /**
     * @param CreateUserCommand $command
     */
    public function __invoke(CreateUserCommand $command) : void
    {
        $user = new User(
            $command->getUuid(),
            $command->getEmail(),
            HashedPassword::encode($command->getPassword())->toString(),
            $this->uniqueUserSpecificationInterface,
            $command->getName());

        $this->userRepository->save($user);
    }

}