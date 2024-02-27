<?php

namespace FondOfOryx\Zed\OrderBudget\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface getFacade()
 */
class OrderBudgetHistoryCleanupConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'order-budget:history:cleanup';

    /**
     * @var string
     */
    public const DESCRIPTION = 'This command will remove old history entries of order budgets.';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::DESCRIPTION);

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
        $this->info('Cleanup order budget history');
        $this->getFacade()->cleanupOrderBudgetHistory();

        return static::CODE_SUCCESS;
    }
}
