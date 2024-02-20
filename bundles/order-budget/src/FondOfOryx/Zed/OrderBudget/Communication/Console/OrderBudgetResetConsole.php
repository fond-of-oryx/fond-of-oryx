<?php

namespace FondOfOryx\Zed\OrderBudget\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface getFacade()
 */
class OrderBudgetResetConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'order-budget:reset';

    /**
     * @var string
     */
    public const DESCRIPTION = 'This command will reset all order budgets.';

    /**
     * @var string
     */
    public const ORDER_BUDGET_IDS_OPTION = 'ids';

    /**
     * @var string
     */
    public const ORDER_BUDGET_IDS_OPTION_SHORTCUT = 'i';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addOption(
            static::ORDER_BUDGET_IDS_OPTION,
            static::ORDER_BUDGET_IDS_OPTION_SHORTCUT,
            InputArgument::OPTIONAL,
            'Defines ids of order budgets which should be reseted, if there is more than one, use comma to separate them. If not, all ids will be rested.',
        );

        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::DESCRIPTION);
        $this->addUsage(sprintf('-%s 1,5', static::ORDER_BUDGET_IDS_OPTION_SHORTCUT));

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
        /** @var array<int> $orderBudgetIds */
        $orderBudgetIds = [];

        if ($input->getOption(static::ORDER_BUDGET_IDS_OPTION)) {
            $idsString = (string)$input->getOption(static::ORDER_BUDGET_IDS_OPTION);
            $orderBudgetIds = array_map('intval', explode(',', $idsString));
        }

        $this->info('Reset order budgets');
        $this->getFacade()->resetOrderBudgets($orderBudgetIds);

        return static::CODE_SUCCESS;
    }
}
