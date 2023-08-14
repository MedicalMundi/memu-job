<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb\Ingesting;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
#[Route(path: '/backoffice/ingesting')]
class SymfonyCliController extends AbstractController
{
    #[Route(path: 'command/ingesting/job', name: 'backoffice_cli_command_ingesting_job')]
    public function command_ingesting_job(KernelInterface $kernel): Response
    {
        return $this->do_command($kernel, 'app:ingesting:job');
    }

    #[Route(path: 'command/ingesting/job', name: 'backoffice_cli_command_ingesting_errata')]
    public function command_ingesting_errata(KernelInterface $kernel): Response
    {
        return $this->do_command($kernel, 'app:ingesting:errata');
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
        $application->run($input, $output);

        $content = $output->fetch();

        return new Response($content);
    }
}
