<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacadeInterface getFacade()
 */
class CreateMissingCompanyBusinessUnitOrderBudgetConsole extends Console
{
    /**
     * @var string
     */
    protected const COMMAND_NAME = 'company-business-unit:missing-order-budget:create';

    /**
     * @var string
     */
    protected const DESCRIPTION = 'Creates missing company business unit order budgets.';

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
        $this->getFacade()->createMissingOrderBudgets();

        return 0;
    }
}
