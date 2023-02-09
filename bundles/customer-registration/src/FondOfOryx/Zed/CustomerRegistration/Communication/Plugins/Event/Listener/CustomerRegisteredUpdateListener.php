<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\Event\Listener;

use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface getFacade()
 */
class CustomerRegisteredUpdateListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @api
     *
     * @inheritDoc
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface|\Generated\Shared\Transfer\EventEntityTransfer $transfer
     * @param string $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        if ($eventName !== CustomerRegistrationConstants::ENTITY_CUSTOMER_UPDATE) {
            return;
        }

        $this->getFacade()->sendWelcomeMail($transfer->getId());
    }
}
