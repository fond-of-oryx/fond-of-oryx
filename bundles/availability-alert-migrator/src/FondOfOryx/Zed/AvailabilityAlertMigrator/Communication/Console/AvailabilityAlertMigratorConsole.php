<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Communication\Console;

use Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Business\AvailabilityAlertMigratorFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface getRepository()
 */
class AvailabilityAlertMigratorConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'availability-alert:migrator:migrate';

    /**
     * @var string
     */
    public const DESCRIPTION = 'Migrates old fos_availability_alert_subscription data to new foo_avilability_alert data structure';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addUsage('');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = static::CODE_SUCCESS;
        $messenger = $this->getMessenger();

        try {
            $this->getFacade()->migrate();
        } catch (Exception $exception) {
            $status = static::CODE_ERROR;
            $messenger->error(sprintf(
                'Command %s failt with message: %s%s!',
                static::COMMAND_NAME,
                PHP_EOL,
                $exception->getMessage(),
            ));
        }

        $messenger->info(sprintf(
            'You just executed %s!',
            static::COMMAND_NAME,
        ));

        return $status;
    }
}
