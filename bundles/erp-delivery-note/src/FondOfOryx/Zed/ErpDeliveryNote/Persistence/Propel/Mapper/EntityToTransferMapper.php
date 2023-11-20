<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence\Propel\Mapper;

use DateTime;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingToItemRelationTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTracking;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingToItem;

class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct(
        ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem $deliveryNoteItem
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|null $deliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function fromErpDeliveryNoteItemToTransfer(
        FooErpDeliveryNoteItem $deliveryNoteItem,
        ?ErpDeliveryNoteItemTransfer $deliveryNoteItemTransfer = null
    ): ErpDeliveryNoteItemTransfer {
        if ($deliveryNoteItemTransfer === null) {
            $deliveryNoteItemTransfer = new ErpDeliveryNoteItemTransfer();
        }
        $deliveryNoteItemTransfer->fromArray($deliveryNoteItem->toArray(), true);

        foreach ($deliveryNoteItem->getFooErpDeliveryNoteTrackingToItems() as $trackingToItem) {
            $trackingEntity = $trackingToItem->getFooErpDeliveryNoteTracking();
            $trackingTransfer = (new ErpDeliveryNoteTrackingTransfer())
                ->fromArray($trackingEntity->toArray(), true)
                ->setQuantity($trackingToItem->getQuantity())
                ->addItemRelation($this->fromItemTrackingRelationToTransfer($trackingToItem));
            $deliveryNoteItemTransfer->addTrackingData($trackingTransfer);
        }

        return $deliveryNoteItemTransfer
            ->setCreatedAt($this->convertDateTimeToTimestamp($deliveryNoteItem->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($deliveryNoteItem->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingToItem $trackingToItem
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingToItemRelationTransfer|null $trackingToItemRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingToItemRelationTransfer
     */
    public function fromItemTrackingRelationToTransfer(
        FooErpDeliveryNoteTrackingToItem $trackingToItem,
        ?ErpDeliveryNoteTrackingToItemRelationTransfer $trackingToItemRelationTransfer = null
    ): ErpDeliveryNoteTrackingToItemRelationTransfer {
        if ($trackingToItemRelationTransfer === null) {
            $trackingToItemRelationTransfer = new ErpDeliveryNoteTrackingToItemRelationTransfer();
        }

        return $trackingToItemRelationTransfer->fromArray($trackingToItem->toArray(), true);
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense $deliveryNoteExpense
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|null $deliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function fromErpDeliveryNoteExpenseToTransfer(
        FooErpDeliveryNoteExpense $deliveryNoteExpense,
        ?ErpDeliveryNoteExpenseTransfer $deliveryNoteExpenseTransfer = null
    ): ErpDeliveryNoteExpenseTransfer {
        if ($deliveryNoteExpenseTransfer === null) {
            $deliveryNoteExpenseTransfer = new ErpDeliveryNoteExpenseTransfer();
        }
        $deliveryNoteExpenseTransfer->fromArray($deliveryNoteExpense->toArray(), true);

        return $deliveryNoteExpenseTransfer
            ->setCreatedAt($this->convertDateTimeToTimestamp($deliveryNoteExpense->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($deliveryNoteExpense->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTracking $deliveryNoteTracking
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|null $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function fromErpDeliveryNoteTrackingToTransfer(
        FooErpDeliveryNoteTracking $deliveryNoteTracking,
        ?ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer = null
    ): ErpDeliveryNoteTrackingTransfer {
        if ($erpDeliveryNoteTrackingTransfer === null) {
            $erpDeliveryNoteTrackingTransfer = new ErpDeliveryNoteTrackingTransfer();
        }
        $erpDeliveryNoteTrackingTransfer->fromArray($deliveryNoteTracking->toArray(), true);

        foreach ($deliveryNoteTracking->getFooErpDeliveryNoteTrackingToItems() as $trackingToItem) {
            $item = (new ErpDeliveryNoteItemTransfer())->fromArray($trackingToItem->getFooErpDeliveryNoteItem()->toArray(), true);
            $erpDeliveryNoteTrackingTransfer->addErpDeliveryNoteItem($item);
        }

        return $erpDeliveryNoteTrackingTransfer
            ->setCreatedAt($this->convertDateTimeToTimestamp($deliveryNoteTracking->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($deliveryNoteTracking->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote $erpDeliveryNote
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function fromErpDeliveryNoteToTransfer(
        FooErpDeliveryNote $erpDeliveryNote,
        ?ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        $addEntityItems = false;

        if ($erpDeliveryNoteTransfer === null) {
            $erpDeliveryNoteTransfer = new ErpDeliveryNoteTransfer();
            $addEntityItems = true;
        }

        $erpDeliveryNoteTransfer->fromArray($erpDeliveryNote->toArray(), true);

        if ($addEntityItems) {
            foreach ($erpDeliveryNote->getFooErpDeliveryNoteItems() as $erpDeliveryNoteItem) {
                $erpDeliveryNoteTransfer->addDeliveryNoteItem($this->fromErpDeliveryNoteItemToTransfer($erpDeliveryNoteItem));
            }
        }

        return $erpDeliveryNoteTransfer
            ->setCompanyBusinessUnit($this->companyBusinessUnitFacade->getCompanyBusinessUnitById((new CompanyBusinessUnitTransfer())->setIdCompanyBusinessUnit($erpDeliveryNote->getFkCompanyBusinessUnit())))
            ->setBillingAddress((new ErpDeliveryNoteAddressTransfer())->fromArray($erpDeliveryNote->getFooErpDeliveryNoteBillingAddress()->toArray(), true))
            ->setShippingAddress((new ErpDeliveryNoteAddressTransfer())->fromArray($erpDeliveryNote->getFooErpDeliveryNoteShippingAddress()->toArray(), true))
            ->setShippingAddress($this->fromErpDeliveryNoteAddressToTransfer($erpDeliveryNote->getFooErpDeliveryNoteShippingAddress()))
            ->setBillingAddress($this->fromErpDeliveryNoteAddressToTransfer($erpDeliveryNote->getFooErpDeliveryNoteBillingAddress()))
            ->setOrderDate($this->convertDateTimeToTimestamp($erpDeliveryNote->getOrderDate()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpDeliveryNote->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpDeliveryNote->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress $erpDeliveryNoteAddress
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|null $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function fromErpDeliveryNoteAddressToTransfer(
        FooErpDeliveryNoteAddress $erpDeliveryNoteAddress,
        ?ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer = null
    ): ErpDeliveryNoteAddressTransfer {
        if ($erpDeliveryNoteAddressTransfer === null) {
            $erpDeliveryNoteAddressTransfer = new ErpDeliveryNoteAddressTransfer();
        }

        $erpDeliveryNoteAddressTransfer->fromArray($erpDeliveryNoteAddress->toArray(), true);

        return $erpDeliveryNoteAddressTransfer
            ->setCountry($this->fromCountryToTransfer($erpDeliveryNoteAddress->getSpyCountry()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpDeliveryNoteAddress->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpDeliveryNoteAddress->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\Country\Persistence\SpyCountry $countryEntity
     * @param \Generated\Shared\Transfer\CountryTransfer|null $countryTransfer
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    public function fromCountryToTransfer(
        SpyCountry $countryEntity,
        ?CountryTransfer $countryTransfer = null
    ): CountryTransfer {
        if ($countryTransfer === null) {
            $countryTransfer = new CountryTransfer();
        }

        return $countryTransfer->fromArray($countryEntity->toArray(), true);
    }

    /**
     * @param mixed $dateTime
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
