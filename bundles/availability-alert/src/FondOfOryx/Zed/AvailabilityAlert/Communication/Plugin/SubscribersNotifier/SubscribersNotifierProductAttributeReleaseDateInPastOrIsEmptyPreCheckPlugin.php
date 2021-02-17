<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\SubscribersNotifier;

use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPreCheckPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Communication\AvailabilityAlertCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig getConfig()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface getQueryContainer()
 */
class SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyPreCheckPlugin extends AbstractPlugin implements SubscribersNotifierPreCheckPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function checkCondition(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): bool
    {
        return $this->getFacade()->preCheckSubscribersNotifierProductAttributeReleaseDateInPastOrIsEmpty($availabilityAlertSubscriptionTransfer);
    }
}
