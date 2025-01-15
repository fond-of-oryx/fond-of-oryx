<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence;

use DateTime;
use Exception;
use FondOfOryx\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException;
use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpPersistenceFactory getFactory()
 */
class ThirtyFiveUpEntityManager extends AbstractEntityManager implements ThirtyFiveUpEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function createThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer
    {
        $thirtyFiveUpOrderTransfer->requireVendorItems();
        $now = new DateTime();
        $entity = new FooThirtyFiveUpOrder();
        $entity->fromArray($thirtyFiveUpOrderTransfer->toArray());
        $entity
            ->setFkSalesOrder($thirtyFiveUpOrderTransfer->getIdSalesOrder())
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        foreach ($thirtyFiveUpOrderTransfer->getVendorItems() as $itemTransfer) {
            $itemTransfer->setIdThirtyFiveUpOrder($entity->getIdThirtyFiveUpOrder());
            $itemTransfer = $this->createThirtyFiveUpOrderItem($itemTransfer);
        }
        $thirtyFiveUpOrderTransfer->fromArray($entity->toArray(), true);
        $thirtyFiveUpOrderTransfer->setId($entity->getIdThirtyFiveUpOrder())
            ->setCreatedAt($this->convertDateTimeToTimestamp($entity->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($entity->getUpdatedAt()));

        return $thirtyFiveUpOrderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @throws \FondOfOryx\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function updateThirtyFiveUpOrder(ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer
    {
        $thirtyFiveUpOrderTransfer->requireId();
        $query = $this->getFactory()->createThirtyFiveUpOrderQuery();

        $entity = $query->findOneByIdThirtyFiveUpOrder($thirtyFiveUpOrderTransfer->getId());

        if ($entity === null) {
            throw new ThirtyFiveUpOrderNotFoundException(sprintf('No thirty five up order with id %s found', $thirtyFiveUpOrderTransfer->getId()));
        }
        $id = $entity->getIdThirtyFiveUpOrder();
        $createdAt = $entity->getCreatedAt();
        $updatedAt = new DateTime();
        $entity->fromArray($thirtyFiveUpOrderTransfer->toArray());
        $entity->setFkSalesOrder($thirtyFiveUpOrderTransfer->getIdSalesOrder())
            ->setIdThirtyFiveUpOrder($id)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
        $entity->save();

        $thirtyFiveUpOrderTransfer->fromArray($entity->toArray(), true);
        $thirtyFiveUpOrderTransfer
            ->setIdSalesOrder($entity->getFkSalesOrder())
            ->setId($id)
            ->setCreatedAt($this->convertDateTimeToTimestamp($entity->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($entity->getUpdatedAt()));

        return $thirtyFiveUpOrderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    public function createThirtyFiveUpOrderItem(ThirtyFiveUpOrderItemTransfer $itemTransfer): ThirtyFiveUpOrderItemTransfer
    {
        $now = new DateTime();
        $itemTransfer
            ->requireIdThirtyFiveUpOrder()
            ->requireSku()
            ->requireQty()
            ->requireVendor();

        $vendor = $this->createOrFindThirtyFiveUpVendor($itemTransfer->getVendor());

        $entity = new FooThirtyFiveUpOrderItem();
        $entity->fromArray($itemTransfer->toArray());
        $entity
            ->setFkThirtyFiveUpVendor($vendor->getId())
            ->setFkThirtyFiveUpOrder($itemTransfer->getIdThirtyFiveUpOrder())
            ->setCreatedAt($now)
            ->setUpdatedAt($now)
            ->save();

        $itemTransfer->fromArray($entity->toArray(), true);
        $itemTransfer
            ->setVendor($vendor)
            ->setId($entity->getIdThirtyFiveUpOrderItem())
            ->setCreatedAt($this->convertDateTimeToTimestamp($entity->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($entity->getUpdatedAt()));

        return $itemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer $vendorTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    public function createOrFindThirtyFiveUpVendor(ThirtyFiveUpVendorTransfer $vendorTransfer): ThirtyFiveUpVendorTransfer
    {
        $vendorTransfer->requireName();

        $query = $this->getFactory()->createThirtyFiveUpVendorQuery();
        $entity = $query->filterByName($vendorTransfer->getName())->findOneOrCreate();
        //@phpstan-ignore-next-line
        if ($entity->getIdThirtyFiveUpVendor() === null) {
            $entity->save();
        }
        $vendorTransfer->fromArray($entity->toArray(), true);
        $vendorTransfer->setId($entity->getIdThirtyFiveUpVendor());

        return $vendorTransfer;
    }

    /**
     * @param \DateTime|mixed|string|null $dateTime
     *
     * @throws \Exception
     *
     * @return int|null
     */
    protected function convertDateTimeToTimestamp($dateTime): ?int
    {
        if ($dateTime === null) {
            return null;
        }

        if ($dateTime instanceof DateTime) {
            return $dateTime->getTimestamp();
        }

        if (is_object($dateTime) === false && is_string($dateTime) === true) {
            return strtotime($dateTime);
        }

        throw new Exception('Could not convert DateTime to timestamp');
    }
}
