<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\CompanyBusinessUnitExtension;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnitExtension\Dependency\Plugin\CompanyBusinessUnitPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacadeInterface getFacade()
 */
class OrderBudgetCompanyBusinessUnitPostSavePlugin extends AbstractPlugin implements CompanyBusinessUnitPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after company business unit object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function postSave(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): CompanyBusinessUnitTransfer
    {
        $this->getFacade()->createOrderBudgetForCompanyBusinessUnit($companyBusinessUnitTransfer);

        return $companyBusinessUnitTransfer;
    }
}
