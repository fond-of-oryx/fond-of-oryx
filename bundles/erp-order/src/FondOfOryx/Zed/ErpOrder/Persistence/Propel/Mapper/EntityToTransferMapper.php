<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper;

use DateTime;
use Exception;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItem;
use Orm\Zed\ErpOrder\Persistence\ErpOrderTotals;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderAmount;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderExpense;

/**
 * @codeCoverageIgnore
 */
class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct(
        ErpOrderToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderItem $orderItem
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer|null $orderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function fromEprOrderItemToTransfer(
        ErpOrderItem $orderItem,
        ?ErpOrderItemTransfer $orderItemTransfer = null
    ): ErpOrderItemTransfer {
        if ($orderItemTransfer === null) {
            $orderItemTransfer = new ErpOrderItemTransfer();
        }
        $orderItemTransfer->fromArray($orderItem->toArray(), true);

        $orderAmount = $orderItem->getFooErpOrderAmount();
        if ($orderAmount !== null) {
            $orderItemTransfer->setAmount((new ErpOrderAmountTransfer())->fromArray($orderAmount->toArray(), true));
        }

        $unitAmount = $orderItem->getFooErpOrderAmountUnitPrice();
        if ($unitAmount !== null) {
            $orderItemTransfer->setUnitPrice((new ErpOrderAmountTransfer())->fromArray($unitAmount->toArray(), true));
        }

        return $orderItemTransfer
            ->setCreatedAt($this->convertDateTimeToTimestamp($orderItem->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($orderItem->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrder $erpOrder
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function fromErpOrderToTransfer(
        ErpOrder $erpOrder,
        ?ErpOrderTransfer $erpOrderTransfer = null
    ): ErpOrderTransfer {
        $addEntityItems = false;

        if ($erpOrderTransfer === null) {
            $erpOrderTransfer = new ErpOrderTransfer();
            $addEntityItems = true;
        }

        $erpOrderTransfer->fromArray($erpOrder->toArray(), true);

        if ($addEntityItems) {
            foreach ($erpOrder->getErpOrderItems() as $erpOrderItem) {
                $erpOrderTransfer->addOrderItem($this->fromEprOrderItemToTransfer($erpOrderItem));
            }
        }

        return $erpOrderTransfer
            ->setCompanyBusinessUnit($this->companyBusinessUnitFacade->getCompanyBusinessUnitById((new CompanyBusinessUnitTransfer())->setIdCompanyBusinessUnit($erpOrder->getFkCompanyBusinessUnit())))
            ->setShippingAddress($this->fromErpOrderAddressToTransfer($erpOrder->getErpOrderShippingAddress()))
            ->setBillingAddress($this->fromErpOrderAddressToTransfer($erpOrder->getErpOrderBillingAddress()))
            ->setTotals($this->fromErpOrderTotalsToTransfer($erpOrder->getErpOrderTotals()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpOrder->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpOrder->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderAddress $erpOrderAddress
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer|null $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function fromErpOrderAddressToTransfer(
        ErpOrderAddress $erpOrderAddress,
        ?ErpOrderAddressTransfer $erpOrderAddressTransfer = null
    ): ErpOrderAddressTransfer {
        if ($erpOrderAddressTransfer === null) {
            $erpOrderAddressTransfer = new ErpOrderAddressTransfer();
        }

        $erpOrderAddressTransfer->fromArray($erpOrderAddress->toArray(), true);
        //ToDo: handle region

        return $erpOrderAddressTransfer
            ->setCountry($this->fromCountryToTransfer($erpOrderAddress->getCountry()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpOrderAddress->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpOrderAddress->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\Country\Persistence\SpyCountry $countryEntity
     * @param \Generated\Shared\Transfer\CountryTransfer|null $countryTransfer
     *
     * @return \Generated\Shared\Transfer\CountryTransfer
     */
    protected function fromCountryToTransfer(
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

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderTotals $erpOrderTotals
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer|null $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function fromErpOrderTotalsToTransfer(
        ErpOrderTotals $erpOrderTotals,
        ?ErpOrderTotalsTransfer $erpOrderTotalsTransfer = null
    ): ErpOrderTotalsTransfer {
        if ($erpOrderTotalsTransfer === null) {
            $erpOrderTotalsTransfer = new ErpOrderTotalsTransfer();
        }

        $erpOrderTotalsTransfer->fromArray($erpOrderTotals->toArray(), true);

        return $erpOrderTotalsTransfer
            ->setGrandTotal($erpOrderTotals->getGrandTotal())
            ->setTaxTotal($erpOrderTotals->getTaxTotal())
            ->setExpenseTaxTotal($erpOrderTotals->getExpenseTaxTotal())
            ->setExpenseTotal($erpOrderTotals->getExpenseTotal());
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\FooErpOrderAmount $erpOrderTotal
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer|null $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function fromErpOrderAmountToTransfer(
        FooErpOrderAmount $erpOrderTotal,
        ?ErpOrderAmountTransfer $erpOrderAmountTransfer = null
    ): ErpOrderAmountTransfer {
        if ($erpOrderAmountTransfer === null) {
            $erpOrderAmountTransfer = new ErpOrderAmountTransfer();
        }

        $erpOrderAmountTransfer->fromArray($erpOrderTotal->toArray(), true);

        return $erpOrderAmountTransfer
            ->setValue($erpOrderTotal->getValue())
            ->setTax($erpOrderTotal->getTax());
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\FooErpOrderExpense $orderExpense
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer|null $orderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function fromEprOrderExpenseToTransfer(
        FooErpOrderExpense $orderExpense,
        ?ErpOrderExpenseTransfer $orderExpenseTransfer = null
    ): ErpOrderExpenseTransfer {
        if ($orderExpenseTransfer === null) {
            $orderExpenseTransfer = new ErpOrderExpenseTransfer();
        }
        $orderExpenseTransfer->fromArray($orderExpense->toArray(), true);

        return $orderExpenseTransfer
            ->setAmount((new ErpOrderAmountTransfer())->fromArray($orderExpense->getFooErpOrderAmount()->toArray(), true))
            ->setUnitPrice((new ErpOrderAmountTransfer())->fromArray($orderExpense->getFooErpOrderAmountUnitPrice()->toArray(), true))
            ->setCreatedAt($this->convertDateTimeToTimestamp($orderExpense->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($orderExpense->getUpdatedAt()));
    }
}
