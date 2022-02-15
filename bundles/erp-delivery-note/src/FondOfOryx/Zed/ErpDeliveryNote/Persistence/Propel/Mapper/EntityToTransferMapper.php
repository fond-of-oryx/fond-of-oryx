<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence\Propel\Mapper;

use DateTime;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCountryFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem;

class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCountryFacadeInterface $countryFacade
     */
    public function __construct(
        ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
        ErpDeliveryNoteToCountryFacadeInterface $countryFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
        $this->countryFacade = $countryFacade;
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

        return $deliveryNoteItemTransfer
            ->setCreatedAt($this->convertDateTimeToTimestamp($deliveryNoteItem->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($deliveryNoteItem->getUpdatedAt()));
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
            ->setCountry($this->countryFacade->getCountryByIdCountry($erpDeliveryNoteAddress->getFkCountry()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpDeliveryNoteAddress->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpDeliveryNoteAddress->getUpdatedAt()));
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
