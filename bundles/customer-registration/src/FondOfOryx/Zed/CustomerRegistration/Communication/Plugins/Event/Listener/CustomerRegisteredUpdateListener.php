<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Event\Listener;

use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Communication\CustomerRegistrationCommunicationFactory getFactory()
 */
class CustomerRegisteredUpdateListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param string $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        if ($eventName !== CustomerRegistrationConstants::ENTITY_CUSTOMER_UPDATE) {
            return;
        }

        $this->getFactory()->getMailFacade()->handleMail($transfer);
    }
}
