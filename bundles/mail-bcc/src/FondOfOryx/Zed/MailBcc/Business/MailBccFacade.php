<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\MailBcc\Business;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class MailBccFacade
 *
 * @package FondOfOryx\Zed\MailBcc\Business
 *
 * @method \FondOfOryx\Zed\MailBcc\Business\MailBccBusinessFactory getFactory()
 */
class MailBccFacade extends AbstractFacade implements MailBccFacadeInterface
{
    /**
     * Specification:
     *  - Expands order mail transfer data with MailBcc groups data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandOrderMailTransfer(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        return $this->getFactory()->createMailBccExpander()->expand($mailTransfer, $orderTransfer);
    }
}
