<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class OrderBudgetReducer implements OrderBudgetReducerInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
     */
    protected $orderBudgetFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
     */
    protected $permissionFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface $permissionFacade
     */
    public function __construct(
        CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade,
        CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface $permissionFacade
    ) {
        $this->orderBudgetFacade = $orderBudgetFacade;
        $this->permissionFacade = $permissionFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function reduceByQuote(QuoteTransfer $quoteTransfer): void
    {
        $companyUserTransfer = $quoteTransfer->requireCompanyUser()
            ->getCompanyUser();

        $companyUserTransfer->requireIdCompanyUser();

        if ($this->permissionFacade->can(AlterCartWithoutLimitPermissionPlugin::KEY, $companyUserTransfer->getIdCompanyUser())) {
            return;
        }

        $orderBudgetTransfer = $companyUserTransfer->requireCompanyBusinessUnit()
           ->getCompanyBusinessUnit()
           ->requireOrderBudget()
           ->getOrderBudget();

        $currentBudget = $orderBudgetTransfer->requireBudget()
            ->getBudget();

        $subTotal = $quoteTransfer->requireTotals()
            ->getTotals()
            ->requireSubtotal()
            ->getSubtotal();

        $this->orderBudgetFacade->updateOrderBudget(
            $orderBudgetTransfer->setBudget($currentBudget - $subTotal),
        );
    }
}
