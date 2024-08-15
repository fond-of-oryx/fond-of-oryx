<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\MailExpander;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory getFactory()
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
        $customerTransfer = $orderTransfer->getCustomer();
        $oneTimePasswordAttributesTransfer = (new OneTimePasswordAttributesTransfer())
            ->setLocale($mailTransfer->getLocale());

        if ($customerTransfer !== null && $customerTransfer->getRegistrationKey() === null) {
            $oneTimePasswordResponseTransfer = $this->getFactory()
                ->getOneTimePasswordFacade()
                ->generateLoginLink($customerTransfer, $oneTimePasswordAttributesTransfer);

            $mailTransfer->setOneTimePasswordLoginLink($oneTimePasswordResponseTransfer->getLoginLink());
        }

        return $mailTransfer;
    }
}
