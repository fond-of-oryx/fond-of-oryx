<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\CompanyBusinessUnitExtension;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnitExtension\Dependency\Plugin\CompanyBusinessUnitExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacadeInterface getFacade()
 */
class OrderBudgetCompanyBusinessUnitExpanderPlugin extends AbstractPlugin implements CompanyBusinessUnitExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands the provided company business unit transfer data and returns the modified object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function expand(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): CompanyBusinessUnitTransfer
    {
        return $this->getFacade()->expandCompanyBusinessUnit($companyBusinessUnitTransfer);
    }
}
