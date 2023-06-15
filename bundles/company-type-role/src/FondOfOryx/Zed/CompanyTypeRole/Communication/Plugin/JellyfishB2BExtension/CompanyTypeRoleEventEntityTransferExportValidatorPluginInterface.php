<?php

namespace FondOfOryx\Zed\CompanyTypeRole\Communication\Plugin\JellyfishB2BExtension;

use FondOfSpryker\Zed\JellyfishB2BExtension\Dependency\Plugin\EventEntityTransferExportValidatorPluginInterface;
use Generated\Shared\Transfer\EventEntityTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleConfig getConfig()
 */
class CompanyTypeRoleEventEntityTransferExportValidatorPluginInterface extends AbstractPlugin implements EventEntityTransferExportValidatorPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $transfer
     *
     * @return bool
     */
    public function validate(EventEntityTransfer $transfer): bool
    {
        return $this->getFacade()->validateCompanyTypeRoleForExport($transfer);
    }
}
