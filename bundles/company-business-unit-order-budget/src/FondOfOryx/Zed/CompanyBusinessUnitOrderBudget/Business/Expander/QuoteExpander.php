<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    public const MESSAGE_TYPE_ERROR = 'error';

    public const MESSAGE_NOT_OWNED_BY_COMPANY_USER = 'company_business_unit_order_budget.not_owned_by_company_user';
    public const MESSAGE_NOT_ASSIGNED_TO_COMPANY_BUSINESS_UNIT = 'company_business_unit_order_budget.not_assigned_company_business_unit';
    public const MESSAGE_NO_ORDER_BUDGET = 'company_business_unit_order_budget.no_order_budget';
    public const MESSAGE_NO_SUBTOTALS = 'company_business_unit_order_budget.no_subtotals';
    public const MESSAGE_NOT_ENOUGH_ORDER_BUDGET = 'company_business_unit_order_budget.no_enough_order_budget';

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
     */
    protected $permissionFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface $permissionFacade
     */
    public function __construct(CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface $permissionFacade)
    {
        $this->permissionFacade = $permissionFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        try {
            $companyUserTransfer = $this->getCompanyUserByQuote($quoteTransfer);

            if ($this->permissionFacade->can(AlterCartWithoutLimitPermissionPlugin::KEY, $companyUserTransfer->getFkCompany())) {
                return $quoteTransfer;
            }

            $orderBudget = $this->getOrderBudgetByCompanyUser($companyUserTransfer);
            $subtotal = $this->getSubtotalByQuote($quoteTransfer);

            if ($orderBudget < $subtotal) {
                throw new Exception(static::MESSAGE_NOT_ENOUGH_ORDER_BUDGET);
            }
        } catch (Exception $exception) {
            $messageTransfer = (new MessageTransfer())->setType(static::MESSAGE_TYPE_ERROR)
                ->setValue($exception->getMessage());

            $quoteTransfer->addValidationMessage($messageTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function getCompanyUserByQuote(QuoteTransfer $quoteTransfer): CompanyUserTransfer
    {
        $companyUserTransfer = $quoteTransfer->getCompanyUser();

        if ($companyUserTransfer === null) {
            throw new Exception(static::MESSAGE_NOT_OWNED_BY_COMPANY_USER);
        }

        return $companyUserTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @throws \Exception
     *
     * @return int
     */
    protected function getOrderBudgetByCompanyUser(
        CompanyUserTransfer $companyUserTransfer
    ): int {
        $companyBusinessUnitTransfer = $companyUserTransfer->getCompanyBusinessUnit();

        if ($companyBusinessUnitTransfer === null) {
            throw new Exception(static::MESSAGE_NOT_ASSIGNED_TO_COMPANY_BUSINESS_UNIT);
        }

        $orderBudgetTransfer = $companyBusinessUnitTransfer->getOrderBudget();

        if ($orderBudgetTransfer === null || $orderBudgetTransfer->getBudget() === null) {
            throw new Exception(static::MESSAGE_NO_ORDER_BUDGET);
        }

        return $orderBudgetTransfer->getBudget();
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \Exception
     *
     * @return int
     */
    protected function getSubtotalByQuote(QuoteTransfer $quoteTransfer): int
    {
        $totalsTransfer = $quoteTransfer->getTotals();

        if ($totalsTransfer === null || $totalsTransfer->getSubtotal() === null) {
            throw new Exception(static::MESSAGE_NO_SUBTOTALS);
        }

        return $totalsTransfer->getSubtotal();
    }
}
