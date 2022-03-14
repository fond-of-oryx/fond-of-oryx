<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorBusinessFactory getFactory()
 */
class CompanyOmsMailConnectorFacade extends AbstractFacade implements CompanyOmsMailConnectorFacadeInterface
{
    /**
     * Specification:
     *  - Expands order mail transfer data with company business unit e-mail address.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOrderMailTransferWithCompanyMailAddress(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        return $this->getFactory()->createMailExpander()->expand($mailTransfer, $orderTransfer);
    }

    /**
     * Specification:
     *  - Expands order mail transfer data with company locale.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOrderMailTransferWithCompanyLocale(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        return $this->getFactory()->createLocaleExpander()->expand($mailTransfer, $orderTransfer);
    }
}
