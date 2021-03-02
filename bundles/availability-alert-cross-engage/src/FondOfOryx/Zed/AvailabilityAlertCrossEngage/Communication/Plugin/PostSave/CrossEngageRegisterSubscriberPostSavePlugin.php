<?php
namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPostSavePluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface getFacade()
 */
class CrossEngageRegisterSubscriberPostSavePlugin extends AbstractPlugin implements AvailabilityAlertSubscriberPostSavePluginInterface
{
    public function postSave(AvailabilityAlertSubscriberTransfer $subscriberTransfer
    ): AvailabilityAlertSubscriberTransfer {
        $response = $this->getFacade()->registerSubscriber($subscriberTransfer);
        return $response->getSubscriber();
    }

}
