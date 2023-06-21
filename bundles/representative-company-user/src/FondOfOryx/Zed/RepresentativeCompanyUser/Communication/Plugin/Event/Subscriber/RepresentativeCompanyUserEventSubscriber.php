<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Subscriber;

use FondOfOryx\Shared\RepresentativeCompanyUser\RepresentativeCompanyUserConstants;
use FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener\RepresentativeCompanyUserCompanyUserCreatorListener;
use FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\Event\Listener\RepresentativeCompanyUserCompanyUserDeleterListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class RepresentativeCompanyUserEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $eventCollection->addListenerQueued(
            RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_EXPIRE,
            new RepresentativeCompanyUserCompanyUserDeleterListener(),
        );
        $eventCollection->addListenerQueued(
            RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_REVOCATION,
            new RepresentativeCompanyUserCompanyUserDeleterListener(),
        );

        $eventCollection->addListenerQueued(
            RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER,
            new RepresentativeCompanyUserCompanyUserCreatorListener(),
        );

        return $eventCollection;
    }
}
