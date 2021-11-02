<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
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
     * @var \FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionTransferExpanderInterface
     */
    protected $expander;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface $localeFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface $storeFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionTransferExpanderInterface $expander
     */
    public function __construct(
        AvailabilityAlertToLocaleInterface $localeFacade,
        AvailabilityAlertToStoreInterface $storeFacade,
        AvailabilityAlertSubscriptionTransferExpanderInterface $expander
    ) {
        $this->localeFacade = $localeFacade;
        $this->storeFacade = $storeFacade;
        $this->expander = $expander;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function mapRequestTransfer(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    ): AvailabilityAlertSubscriptionTransfer {
        $this->assertAvailabilityAlertSubscriptionRequestTransfer($availabilityAlertSubscriptionRequestTransfer);

        $availabilityAlertSubscriptionTransfer = new AvailabilityAlertSubscriptionTransfer();

        $availabilityAlertSubscriptionTransfer
            ->fromArray($availabilityAlertSubscriptionRequestTransfer->modifiedToArray(), true)
            ->setFkProductAbstract($availabilityAlertSubscriptionRequestTransfer->getIdProductAbstract())
            ->setFkLocale($this->getIdLocale($availabilityAlertSubscriptionRequestTransfer))
            ->setFkStore($this->getIdStore($availabilityAlertSubscriptionRequestTransfer))
            ->setSubscriber($this->mapSubscriber($availabilityAlertSubscriptionRequestTransfer));

        return $this->expander->expandWithSubscriptionRequest($availabilityAlertSubscriptionTransfer, $availabilityAlertSubscriptionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    protected function mapSubscriber(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    ): AvailabilityAlertSubscriberTransfer {
        return (new AvailabilityAlertSubscriberTransfer())->fromArray(
            $availabilityAlertSubscriptionRequestTransfer->toArray(),
            true,
        );
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
        return $this->storeFacade->getStoreByName($availabilityAlertSubscriptionRequestTransfer->getStore())->getIdStore();
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
