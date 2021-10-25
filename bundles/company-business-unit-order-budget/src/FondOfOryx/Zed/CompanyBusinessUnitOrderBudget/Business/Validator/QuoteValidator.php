<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception\NotEnoughOrderBudgetException;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidator implements QuoteValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
     */
    protected $permissionFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface $permissionFacade
     */
    public function __construct(
        CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface $permissionFacade
    ) {
        $this->permissionFacade = $permissionFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Exception\NotEnoughOrderBudgetException
     *
     * @return void
     */
    public function validate(QuoteTransfer $quoteTransfer): void
    {
        $companyUserTransfer = $quoteTransfer->requireCompanyUser()
            ->getCompanyUser();

        $companyUserTransfer->requireIdCompanyUser();

        if ($this->permissionFacade->can(AlterCartWithoutLimitPermissionPlugin::KEY, $companyUserTransfer->getIdCompanyUser())) {
            return;
        }

        $budget = $companyUserTransfer->requireCompanyBusinessUnit()
            ->getCompanyBusinessUnit()
            ->requireOrderBudget()
            ->getOrderBudget()
            ->requireBudget()
            ->getBudget();

        $subTotal = $quoteTransfer->requireTotals()
            ->getTotals()
            ->requireSubtotal()
            ->getSubtotal();

        if ($budget < $subTotal) {
            throw new NotEnoughOrderBudgetException('Order budget is lower then subtotal quote.');
        }
    }
}
