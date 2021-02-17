<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use DateTime;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface;
use FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription;
use Orm\Zed\AvailabilityAlert\Persistence\Map\FosAvailabilityAlertSubscriptionTableMap;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\DecimalObject\Decimal;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Availability\Business\AvailabilityFacadeInterface;

class SubscribersNotifier implements SubscribersNotifierInterface
{
    /**
     * @var \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface
     */
    protected $availabilityFacade;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\MailHandler
     */
    protected $mailHandler;

    /**
     * @var int
     */
    protected $minimalPercentageDifference;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface
     */
    protected $subscribersNotifierPluginExecutor;

    /**
     * @param \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface $availabilityFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\Model\MailHandler $mailHandler
     * @param \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertQueryContainerInterface $queryContainer
     * @param int $minimalPercentageDifference
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface $subscribersNotifierPluginExecutor
     */
    public function __construct(
        AvailabilityFacadeInterface $availabilityFacade,
        MailHandler $mailHandler,
        AvailabilityAlertQueryContainerInterface $queryContainer,
        $minimalPercentageDifference,
        SubscribersNotifierPluginExecutorInterface $subscribersNotifierPluginExecutor
    ) {
        $this->availabilityFacade = $availabilityFacade;
        $this->mailHandler = $mailHandler;
        $this->queryContainer = $queryContainer;
        $this->minimalPercentageDifference = $minimalPercentageDifference;
        $this->subscribersNotifierPluginExecutor = $subscribersNotifierPluginExecutor;
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface
     */
    public function notify(): SubscribersNotifierInterface
    {
        $countOfSubscriberPerProductAbstract = $this->getCountOfSubscriberPerProductAbstract();

        foreach ($this->getSubscritpions() as $fosAvailabilityAlertSubscription) {
            if (!$this->canSendNotification($fosAvailabilityAlertSubscription, $countOfSubscriberPerProductAbstract)) {
                continue;
            }

            $isPassed = $this->subscribersNotifierPluginExecutor->executePreCheckPlugins(
                $this->createAvailabilityAlertSubscriptionTransfer($fosAvailabilityAlertSubscription)
            );

            if ($isPassed === false) {
                continue;
            }

            $this->sendNotification($fosAvailabilityAlertSubscription);
        }

        return $this;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    protected function createAvailabilityAlertSubscriptionTransfer(
        FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
    ): AvailabilityAlertSubscriptionTransfer {
        $availabilityAlertSubscriptionTransfer = new AvailabilityAlertSubscriptionTransfer();
        $availabilityAlertSubscriptionTransfer->fromArray($fosAvailabilityAlertSubscription->toArray(), true);

        return $availabilityAlertSubscriptionTransfer;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return $this
     */
    protected function sendNotification(FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription)
    {
        $this->mailHandler->sendAvailabilityAlertMail($fosAvailabilityAlertSubscription);

        $fosAvailabilityAlertSubscription->setSentAt(new DateTime())
            ->setStatus(FosAvailabilityAlertSubscriptionTableMap::COL_STATUS_NOTIFIED)
            ->save();

        return $this;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     * @param array $countOfSubscriberPerProductAbstract
     *
     * @return bool
     */
    protected function canSendNotification(
        FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription,
        $countOfSubscriberPerProductAbstract
    ): bool {
        $percentageDifference = $this->calculatePercentageDifference(
            $fosAvailabilityAlertSubscription,
            $countOfSubscriberPerProductAbstract
        );

        return $percentageDifference > $this->minimalPercentageDifference;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     * @param array $countOfSubscriberPerProductAbstract
     *
     * @return float|int
     */
    protected function calculatePercentageDifference(
        FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription,
        $countOfSubscriberPerProductAbstract
    ) {
        $fkProductAbstract = $fosAvailabilityAlertSubscription->getFkProductAbstract();
        $subscriberCount = $countOfSubscriberPerProductAbstract[$fkProductAbstract];
        $availability = $this->getAvailability($fosAvailabilityAlertSubscription)->toInt();

        return $availability * 100 / $subscriberCount;
    }

    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
     *
     * @return \Spryker\DecimalObject\Decimal|null
     */
    protected function getAvailability(
        FosAvailabilityAlertSubscription $fosAvailabilityAlertSubscription
    ): ?Decimal {
        $productAbstractAvailability = $this->availabilityFacade->getProductAbstractAvailability(
            $fosAvailabilityAlertSubscription->getFkProductAbstract(),
            $fosAvailabilityAlertSubscription->getFkLocale()
        );

        return $productAbstractAvailability->getAvailability();
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription[]|\Propel\Runtime\Collection\ObjectCollection
     */
    protected function getSubscritpions()
    {
        $idStore = $this->getIdStoreByStoreName(Store::getInstance()->getStoreName());

        return $this->queryContainer
            ->querySubscriptionsByIdStoreAndStatus($idStore, 0)
            ->find();
    }

    /**
     * @return int[]
     */
    protected function getCountOfSubscriberPerProductAbstract(): array
    {
        return $this->queryContainer->queryCountOfSubscriberPerProductAbstract()
            ->find()
            ->toKeyValue(FosAvailabilityAlertSubscriptionTableMap::COL_FK_PRODUCT_ABSTRACT, 'count_of_subscriber');
    }

    /**
     * @param string $storeName
     *
     * @return int
     */
    protected function getIdStoreByStoreName(string $storeName): int
    {
        $storeEntity = SpyStoreQuery::create()
            ->filterByName($storeName)
            ->findOne();

        if ($storeEntity === null) {
            return 0;
        }

        return $storeEntity->getIdStore();
    }
}
