<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class SymfonyCliController extends AbstractController
{
    #[Route(path: '/command/cache/clear', name: 'sys_cli_command_cache_clear')]
    public function command_cache_clear(KernelInterface $kernel): Response
    {
        return $this->do_command($kernel, 'cache:clear');
    }

    #[Route(path: '/c/c/c', name: 'sys_cli_command_cache_clear_2')]
    public function command_cache_clear2(KernelInterface $kernel): Response
    {
        return $this->do_command($kernel, 'cache:clear');
    }

    #[Route(path: 'command/db/migrate', name: 'sys_cli_command_migrations_run')]
    public function command_migrations_run(KernelInterface $kernel): Response
    {
        return $this->do_commandWithOptions($kernel, 'doctrine:migrations:migrate');
    }

    #[Route(path: 'command/ingesting/job', name: 'sys_cli_command_ingesting_job')]
    public function command_ingesting_job(KernelInterface $kernel): Response
    {
        return $this->do_command($kernel, 'app:ingesting:job');
    }

    private function do_command(KernelInterface $kernel, string $command): Response
    {
        $env = $kernel->getEnvironment();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => $command,
            '--env' => $env,
        ]);

        $output = new BufferedOutput();
        try {
            $application->run($input, $output);
        } catch (\Throwable $throwable) {
            $content = $throwable->getMessage();
            return new Response($content);
        }


        $content = $output->fetch();

        return new Response($content);
    }

    private function do_commandWithOptions(KernelInterface $kernel, string $command, array $options = []): Response
    {
        $env = $kernel->getEnvironment();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => $command,
            '--env' => $env,
            '--no-interaction' => true,
            '--allow-no-migration' => true,
        ]);

        $output = new BufferedOutput();
        $application->run($input, $output);

        $content = $output->fetch();

        return new Response($content);
    }
}
