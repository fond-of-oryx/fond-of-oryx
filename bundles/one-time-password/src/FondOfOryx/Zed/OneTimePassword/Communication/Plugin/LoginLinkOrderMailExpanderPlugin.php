<?php

namespace FondOfOryx\Zed\OneTimePassword\Communication\Plugin;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\OneTimePassword\Business\OneTimePasswordFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig getConfig()
 */
class LoginLinkOrderMailExpanderPlugin extends AbstractPlugin implements OmsOrderMailExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        $oneTimePasswordResponseTransfer = $this->getFacade()->generateLoginLinkWithOrderReference($orderTransfer, new OneTimePasswordAttributesTransfer());

        $mailTransfer->setOneTimePasswordLoginLink($oneTimePasswordResponseTransfer->getLoginLink());

        return $mailTransfer;
    }
}
