<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertSubscriptionSubmitMapper implements AvailabilityAlertSubscriptionSubmitMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface
     */
    protected $storeFacade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface $localeFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface $storeFacade
     */
    public function __construct(
        AvailabilityAlertToLocaleInterface $localeFacade,
        AvailabilityAlertToStoreInterface $storeFacade
    ) {
        $this->localeFacade = $localeFacade;
        $this->storeFacade = $storeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function mapRequestTransfer(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    ) {

        $this->assertAvailabilityAlertSubscriptionRequestTransfer($availabilityAlertSubscriptionRequestTransfer);

        $availabilityAlertSubscriptionTransfer = new AvailabilityAlertSubscriptionTransfer();

        $availabilityAlertSubscriptionTransfer
            ->fromArray($availabilityAlertSubscriptionRequestTransfer->modifiedToArray(), true)
            ->setFkProductAbstract($availabilityAlertSubscriptionRequestTransfer->getIdProductAbstract())
            ->setFkLocale($this->getIdLocale($availabilityAlertSubscriptionRequestTransfer))
            ->setFkStore($this->getIdStore($availabilityAlertSubscriptionRequestTransfer));

        return $availabilityAlertSubscriptionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return int
     */
    protected function getIdLocale(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    ): int {
        return $this->localeFacade->getLocale($availabilityAlertSubscriptionRequestTransfer->getLocaleName())->getIdLocale();
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return int
     */
    protected function getIdStore(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    ): int {
        return $this->storeFacade->getStore($availabilityAlertSubscriptionRequestTransfer->getStore())->getIdStore();
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return void
     */
    protected function assertAvailabilityAlertSubscriptionRequestTransfer(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    ): void {
        $availabilityAlertSubscriptionRequestTransfer
            ->requireIdProductAbstract()
            ->requireEmail()
            ->requireLocaleName();
    }
}
