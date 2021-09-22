<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitExpander implements CompanyBusinessUnitExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
     */
    protected $orderBudgetFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade
     */
    public function __construct(CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade)
    {
        $this->orderBudgetFacade = $orderBudgetFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function expand(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): CompanyBusinessUnitTransfer
    {
        $fkOrderBudget = $companyBusinessUnitTransfer->getFkOrderBudget();

        if ($fkOrderBudget === null) {
            return $companyBusinessUnitTransfer;
        }

        return $companyBusinessUnitTransfer->setOrderBudget(
            $this->orderBudgetFacade->findOrderBudgetByIdOrderBudget($fkOrderBudget)
        );
    }
}
