<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business;

use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyBusinessFactory getFactory()
 */
class FallbackLocaleMailProxyFacade extends AbstractFacade implements FallbackLocaleMailProxyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expandMail(MailTransfer $mailTransfer): MailTransfer
    {
        return $this->getFactory()
            ->createMailExpander()
            ->expand($mailTransfer);
    }
}
