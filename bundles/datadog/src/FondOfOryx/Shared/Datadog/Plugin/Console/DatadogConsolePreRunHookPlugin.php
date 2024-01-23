<?php

namespace FondOfOryx\Shared\Datadog\Plugin\Console;

use Spryker\Shared\Console\Dependency\Plugin\ConsolePreRunHookPluginInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function DDTrace\root_span;

/**
 * @codeCoverageIgnore
 */
class DatadogConsolePreRunHookPlugin implements ConsolePreRunHookPluginInterface
{
    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    public function preRun(InputInterface $input, OutputInterface $output)
    {
        if (!extension_loaded('ddtrace')) {
            return 0;
        }

        $span = root_span();

        if ($span === null) {
            return 0;
        }

        $span->resource = $input->getFirstArgument();
        $span->meta['cli.command'] = $input->getFirstArgument();

        foreach ($this->getArgumentsByInput($input) as $index => $argument) {
            $span->meta['cli.arguments.' . $index] = $argument;
        }

        return 0;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return array
     */
    protected function getArgumentsByInput(InputInterface $input): array
    {
        if (!method_exists($input, '__toString')) {
            return [];
        }

        $arguments = explode(' ', $input->__toString());

        return array_slice($arguments, 1);
    }
}
