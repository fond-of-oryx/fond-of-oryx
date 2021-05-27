<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Form\DataProvider;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class SubscriptionFormDataProvider
{
    /**
     * @param $idProductAbstract
     * @param  int|null  $idProductConcrete
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    public function getData($idProductAbstract, ?int $idProductConcrete = null)
    {
        $availabilityAlertRequestTransfer = new AvailabilityAlertSubscriptionRequestTransfer();
        $availabilityAlertRequestTransfer->setIdProductAbstract($idProductAbstract);
        $availabilityAlertRequestTransfer->setIdProductConcrete($idProductConcrete);

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
