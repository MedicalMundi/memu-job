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
    /**
     * @Route("/command/cache/clear", name="sys_cli_command_cache_clear")
     */
    public function command_cache_clear(KernelInterface $kernel): Response
    {
        return $this->do_command($kernel, 'cache:clear');
    }

    /**
     * @Route("command/db/migrate", name="sys_cli_command_migrations_run")
     */
    #[Route('/command/db/migrate', name: 'sys_cli_command_migrations_run')]
    public function command_migrations_run(KernelInterface $kernel): Response
    {
        return $this->do_commandWithOptions($kernel, 'doctrine:migrations:migrate');
    }

    private function do_command($kernel, $command): Response
    {
        $env = $kernel->getEnvironment();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => $command,
            '--env' => $env,
        ]);

        $output = new BufferedOutput();
        $application->run($input, $output);

        $content = $output->fetch();

        return new Response($content);
    }

    private function do_commandWithOptions($kernel, $command, array $options = []): Response
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
