<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\Map\FooAvailabilityAlertSubscriptionTableMap;

class SubscriptionManager implements SubscriptionManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutorInterface
     */
    protected $availabilityAlertSubscriberPluginExecutor;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutorInterface
     */
    protected $availabilityAlertSubscriptionPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface $repository
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface $storeFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriptionPluginExecutorInterface $subscriptionPluginExecutor
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor\AvailabilityAlertSubscriberPluginExecutorInterface $subscriberPluginExecutor
     */
    public function __construct(
        AvailabilityAlertEntityManagerInterface $entityManager,
        AvailabilityAlertRepositoryInterface $repository,
        AvailabilityAlertToStoreInterface $storeFacade,
        AvailabilityAlertSubscriptionPluginExecutorInterface $subscriptionPluginExecutor,
        AvailabilityAlertSubscriberPluginExecutorInterface $subscriberPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->storeFacade = $storeFacade;
        $this->availabilityAlertSubscriptionPluginExecutor = $subscriptionPluginExecutor;
        $this->availabilityAlertSubscriberPluginExecutor = $subscriberPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function isAlreadySubscribed(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): bool {
        $availabilityAlertSubscriptionTransfer->requireSubscriber();
        $availabilityAlertSubscriptionTransfer->requireFkProductAbstract();
        $subscriber = $availabilityAlertSubscriptionTransfer->getSubscriber();
        $subscriber->requireEmail();

        $subscription = $this->repository
            ->findSubscriptionByEmailAndIdProductAbstractAndStatus(
                $subscriber->getEmail(),
                $availabilityAlertSubscriptionTransfer->getFkProductAbstract(),
                FooAvailabilityAlertSubscriptionTableMap::COL_STATUS_PENDING,
            );

        return $subscription !== null;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param bool $preferFromTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        bool $preferFromTransfer
    ): AvailabilityAlertSubscriptionTransfer {
        $availabilityAlertSubscriptionTransfer->requireFkProductAbstract();
        $availabilityAlertSubscriptionTransfer->requireFkLocale();
        $availabilityAlertSubscriptionTransfer->requireFkStore();

        $subscriber = $this->handleSubscriber($availabilityAlertSubscriptionTransfer);

        $availabilityAlertSubscriptionTransfer
            ->setSubscriber($subscriber)
            ->setSentAt($preferFromTransfer === true ? $availabilityAlertSubscriptionTransfer->getSentAt() : null)
            ->setStatus($preferFromTransfer === true ? $availabilityAlertSubscriptionTransfer->getStatus() : FooAvailabilityAlertSubscriptionTableMap::COL_STATUS_PENDING)
            ->setFkSubscriber($subscriber->getIdAvailabilityAlertSubscriber());

        return $this->handleSubscription($availabilityAlertSubscriptionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function updateSubscription(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): AvailabilityAlertSubscriptionTransfer
    {
        $availabilityAlertSubscriptionTransfer
            ->requireFkProductAbstract()
            ->requireFkLocale()
            ->requireFkStore()
            ->requireFkSubscriber();

        return $this->handleSubscription($availabilityAlertSubscriptionTransfer);
    }

    /**
     * @return array
     */
    public function getCurrentSubscriptionCountPerProductAbstract(): array
    {
        return $this->repository->getCountOfSubscriberPerProductAbstract();
    }

    /**
     * @param int $status
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer
     */
    public function getSubscriptionsForCurrentStoreAndStatus(int $status): AvailabilityAlertSubscriptionCollectionTransfer
    {
        $currentStore = $this->storeFacade->getCurrentStore();

        return $this->repository->findSubscriptionsByIdStoreAndStatus($currentStore->getIdStore(), $status);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    protected function handleSubscriber(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): AvailabilityAlertSubscriberTransfer
    {
        $subscriber = false;

        if ($availabilityAlertSubscriptionTransfer->getFkSubscriber() === null) {
            $availabilityAlertSubscriptionTransfer->requireSubscriber();
            $subscriber = $this->appendBusinessUnit($availabilityAlertSubscriptionTransfer, $availabilityAlertSubscriptionTransfer->getSubscriber());
            $subscriber->requireEmail();
        }

        if ($subscriber === false) {
            $subscriber = $this->repository->findSubscriberById($availabilityAlertSubscriptionTransfer->getFkSubscriber());
        }

        $subscriber = $this->availabilityAlertSubscriberPluginExecutor->executePreSavePlugins($subscriber, $availabilityAlertSubscriptionTransfer);
        $subscriber = $this->entityManager->createOrUpdateSubscriber($subscriber);
        $subscriber = $this->availabilityAlertSubscriberPluginExecutor->executePostSavePlugins($subscriber, $availabilityAlertSubscriptionTransfer);

        return $subscriber;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    protected function handleSubscription(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): AvailabilityAlertSubscriptionTransfer
    {
        $availabilityAlertSubscriptionTransfer = $this->availabilityAlertSubscriptionPluginExecutor->executePreSavePlugins($availabilityAlertSubscriptionTransfer);
        $availabilityAlertSubscriptionTransfer = $this->entityManager->createOrUpdateSubscription($availabilityAlertSubscriptionTransfer);

        return $this->availabilityAlertSubscriptionPluginExecutor->executePostSavePlugins($availabilityAlertSubscriptionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    protected function appendBusinessUnit(
        AvailabilityAlertSubscriptionTransfer $subscriptionTransfer,
        AvailabilityAlertSubscriberTransfer $subscriberTransfer
    ): AvailabilityAlertSubscriberTransfer {
        $locale = $subscriptionTransfer->getLocale();

        if ($locale === null || method_exists($subscriberTransfer, 'setBusinessUnit') === false) {
            return $subscriberTransfer;
        }

        return $subscriberTransfer->setBusinessUnit($locale->getLocaleName());
    }
}
