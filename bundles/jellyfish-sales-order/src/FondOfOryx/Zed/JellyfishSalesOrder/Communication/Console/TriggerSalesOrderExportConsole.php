<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface getRepository()
 */
class TriggerSalesOrderExportConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'jellyfish-sales-order:export:trigger';

    /**
     * @var string
     */
    public const COMMAND_DESCRIPTION = 'Trigger sales order export.';

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
        $this->getFacade()->triggerSalesOrderExport();

        return static::CODE_SUCCESS;
    }
}
