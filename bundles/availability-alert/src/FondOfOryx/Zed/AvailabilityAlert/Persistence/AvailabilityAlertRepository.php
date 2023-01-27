<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

use FondOfOryx\Zed\AvailabilityAlert\Exception\SubscriberNotFoundException;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\Map\FooAvailabilityAlertSubscriberTableMap;
use Orm\Zed\AvailabilityAlert\Persistence\Map\FooAvailabilityAlertSubscriptionTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertPersistenceFactory getFactory()
 */
class AvailabilityAlertRepository extends AbstractRepository implements AvailabilityAlertRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|null
     */
    public function findSubscriberByMail(string $email): ?AvailabilityAlertSubscriberTransfer
    {
        $query = $this->getFactory()->createAvailabilityAlertSubscriberQuery();

        $entity = $query->findOneByEmail($email);
        if ($entity === null) {
            return null;
        }

        return $this->getFactory()->createAvailabilityAlertSubscriberMapper()->fromEntity($entity);
    }

    /**
     * @param int $idSubscriber
     *
     * @throws \FondOfOryx\Zed\AvailabilityAlert\Exception\SubscriberNotFoundException
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function findSubscriberById(int $idSubscriber): AvailabilityAlertSubscriberTransfer
    {
        $query = $this->getFactory()->createAvailabilityAlertSubscriberQuery();

        $entity = $query->findOneByIdAvailabilityAlertSubscriber($idSubscriber);
        if ($entity === null) {
            throw new SubscriberNotFoundException(sprintf('Subscriber with ID "%s" not found!', $idSubscriber));
        }

        return $this->getFactory()->createAvailabilityAlertSubscriberMapper()->fromEntity($entity);
    }

    /**
     * @param string $mail
     * @param int $idProductAbstract
     * @param string $status
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|null
     */
    public function findSubscriptionByEmailAndIdProductAbstractAndStatus(
        string $mail,
        int $idProductAbstract,
        string $status
    ): ?AvailabilityAlertSubscriptionTransfer {
        $query = $this->getFactory()->createAvailabilityAlertSubscriptionQuery();
        $query->joinWithFooAvailabilityAlertSubscriber(FooAvailabilityAlertSubscriberTableMap::TABLE_NAME)->useFooAvailabilityAlertSubscriberQuery()->filterByEmail($mail)->endUse()->filterByStatus($status);

        $entity = $query->findOneByFkProductAbstract($idProductAbstract);

        if ($entity === null) {
            return null;
        }

        return $this->getFactory()->createAvailabilityAlertSubscriptionMapper()->fromEntity($entity);
    }

    /**
     * @return array
     */
    public function getCountOfSubscriberPerProductAbstract(): array
    {
        $query = $this->getFactory()->createAvailabilityAlertSubscriptionQuery();
        $query->filterByStatus(FooAvailabilityAlertSubscriptionTableMap::COL_STATUS_PENDING)
            ->withColumn('COUNT(*)', 'count_of_subscriber')
            ->select(['count_of_subscriber', FooAvailabilityAlertSubscriptionTableMap::COL_FK_PRODUCT_ABSTRACT])
            ->groupByFkProductAbstract();

        return $query->find()
        ->toKeyValue(FooAvailabilityAlertSubscriptionTableMap::COL_FK_PRODUCT_ABSTRACT, 'count_of_subscriber');
    }

    /**
     * @param int $idStore
     * @param string $status
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer
     */
    public function findSubscriptionsByIdStoreAndStatus(int $idStore, string $status): AvailabilityAlertSubscriptionCollectionTransfer
    {
        $query = $this->getFactory()->createAvailabilityAlertSubscriptionQuery()
            ->filterByFkStore($idStore)
            ->filterByStatus($status);

        $data = $query->find()->getData();
        $collection = new AvailabilityAlertSubscriptionCollectionTransfer();
        foreach ($data as $entity) {
            $collection->addSubscription($this->getFactory()->createAvailabilityAlertSubscriptionMapper()->fromEntity($entity));
        }

        return $collection;
    }
}
