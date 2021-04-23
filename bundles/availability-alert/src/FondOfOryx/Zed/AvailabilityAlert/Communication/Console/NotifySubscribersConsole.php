<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Console;

use Exception;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Communication\AvailabilityAlertCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface getQueryContainer()
 */
class NotifySubscribersConsole extends Console
{
    use LoggerTrait;

    public const COMMAND_NAME = 'availabiliy-alert:notify-subscribers';
    public const COMMAND_DESCRIPTION = 'Notify subscribers that products are available again.';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::COMMAND_DESCRIPTION);
        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->getFacade()->notifySubscribers();
        } catch (Exception $exception) {
            $this->getLogger()->error($exception->getMessage(), $exception->getTrace());

            return Console::CODE_ERROR;
        }

        return Console::CODE_SUCCESS;
    }
}
