<?php


namespace App\Core\Application\Command\User\CreateUser;


use App\Core\Domain\Model\User\User;
use App\Core\Domain\Model\User\UserRepositoryInterface;
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
    public function __invoke(CreateUserCommand $command) : void {
        $user = new User($command->getEmail(), $command->getName(), $command->getPassword());
        $this->userRepository->save($user);
    }

}