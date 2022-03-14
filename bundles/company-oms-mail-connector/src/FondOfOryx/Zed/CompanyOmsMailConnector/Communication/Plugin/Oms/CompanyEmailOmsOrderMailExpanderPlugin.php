<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Communication\Plugin\Oms;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorFacadeInterface getFacade()
 */
class CompanyEmailOmsOrderMailExpanderPlugin extends AbstractPlugin implements OmsOrderMailExpanderPluginInterface
{
    /**
     * Specification:
     *  - Expands order mail transfer data with CompanyOmsMailConnector groups data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        return $this->getFacade()->expandOrderMailTransferWithCompanyMailAddress($mailTransfer, $orderTransfer);
    }
}
