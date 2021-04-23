<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Form\DataProvider;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class SubscriptionFormDataProvider
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    public function getData($idProductAbstract)
    {
        $availabilityAlertRequestTransfer = new AvailabilityAlertSubscriptionRequestTransfer();
        $availabilityAlertRequestTransfer->setIdProductAbstract($idProductAbstract);

        return $availabilityAlertRequestTransfer;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            'data_class' => AvailabilityAlertSubscriptionRequestTransfer::class,
        ];
    }
}
