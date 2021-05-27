<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \FondOfOryx\Yves\AvailabilityAlert\AvailabilityAlertFactory getFactory()
 */
class AvailabilityAlertFormWidget extends AbstractWidget
{
    /**
     * AvailabilityAlertFormWidget constructor.
     *
     * @param  int  $idProductAbstract
     * @param  int|null  $idProductConcrete
     */
    public function __construct(int $idProductAbstract, ?int $idProductConcrete = null)
    {
        $this->addParameter('availabilityAlertFormWidget', $this->getFactory()->createSubscriptionForm($idProductAbstract, $idProductConcrete)->createView());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'AvailabilityAlertFormWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@AvailabilityAlert/views/submit/form-widget.twig';
    }
}
