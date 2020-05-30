<?php


namespace App\Core\Application\Command\User\CreateUser;


use App\Core\Domain\Model\User\User;
use App\Core\Domain\Model\User\UserRepositoryInterface;
use App\Core\Domain\ValueObject\Email;
use App\Core\Domain\ValueObject\HashedPassword;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    private UserRepositoryInterface $userRepository;

    /**
     * CreateUserCommandHandler constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function __invoke(CreateUserCommand $command) : void
    {
        $user = new User(
            $command->getUuid(),
            Email::fromString($command->getEmail()),
            $command->getName(),
            HashedPassword::encode($command->getPassword()));

        $this->userRepository->save($user);
    }

}