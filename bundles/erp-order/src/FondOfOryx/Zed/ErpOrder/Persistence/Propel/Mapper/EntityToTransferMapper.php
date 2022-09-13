<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper;

use DateTime;
use Exception;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItem;
use Orm\Zed\ErpOrder\Persistence\ErpOrderTotals;

/**
 * @codeCoverageIgnore
 */
class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     * @param \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeInterface $countryFacade
     */
    public function __construct(
        ErpOrderToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
        ErpOrderToCountryFacadeInterface $countryFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
        $this->countryFacade = $countryFacade;
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
            ->setCountry($this->countryFacade->getCountryByIdCountry($erpOrderAddress->getFkCountry()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpOrderAddress->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpOrderAddress->getUpdatedAt()));
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
            ->setTaxTotal($erpOrderTotals->getTaxTotal());
    }
}
