<?php declare(strict_types=1);

namespace App\Command;

use App\Entity\BackofficeUser;
use App\Repository\BackofficeUserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminCreateCommand extends Command
{
    protected static $defaultName = 'app:admin:create';

    protected static $defaultDescription = 'Crea un nuovo utente amministratore';

    private BackofficeUserRepository $userRepository;

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(BackofficeUserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'Email dell\'amministratore')
            ->addArgument('password', InputArgument::OPTIONAL, 'Password dell\'amministratoreArgument descriptio')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = (string) $input->getArgument('email');

        if ('' === $email) {
            $io->note('Inserire l\'email dell\' utente.');

            return Command::FAILURE;
        }

        $password = (string) $input->getArgument('password');

        if ('' === $password) {
            $io->note('Inserire la password dell\' utente.');

            return Command::FAILURE;
        }

        $adminUser = BackofficeUser::create($email, $password);
        $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, $password));
        $adminUser->setRoles(['ROLE_ADMIN']);

        try {
            $this->userRepository->add($adminUser, true);

            $io->success('Utente amministratore creato.');

            return Command::SUCCESS;
        } catch (\Exception $exception) {
            $io->error($exception->getMessage());
        }

        return Command::FAILURE;
    }
}
