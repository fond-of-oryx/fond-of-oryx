<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CountryOmsMailConnector\Business\CountryOmsMailConnectorBusinessFactory getFactory()
 */
class CountryOmsMailConnectorFacade extends AbstractFacade implements CountryOmsMailConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOmsOrderMail(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        return $this->getFactory()
            ->createOmsOrderMailExpander()
            ->expand($mailTransfer, $orderTransfer);
    }
}
