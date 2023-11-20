<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence\Propel\Mapper;

use DateTime;
use Exception;
use FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoice;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem;

class EntityToTransferMapper implements EntityToTransferMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct(
        ErpInvoiceToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
    ) {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem $invoiceItem
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer|null $invoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function fromEprInvoiceItemToTransfer(
        FooErpInvoiceItem $invoiceItem,
        ?ErpInvoiceItemTransfer $invoiceItemTransfer = null
    ): ErpInvoiceItemTransfer {
        if ($invoiceItemTransfer === null) {
            $invoiceItemTransfer = new ErpInvoiceItemTransfer();
        }
        $invoiceItemTransfer->fromArray($invoiceItem->toArray(), true);

        return $invoiceItemTransfer
            ->setAmount((new ErpInvoiceAmountTransfer())->fromArray($invoiceItem->getFooErpInvoiceAmount()->toArray(), true))
            ->setUnitPrice((new ErpInvoiceAmountTransfer())->fromArray($invoiceItem->getFooErpInvoiceAmountUnitPrice()->toArray(), true))
            ->setCreatedAt($this->convertDateTimeToTimestamp($invoiceItem->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($invoiceItem->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense $invoiceExpense
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|null $invoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function fromEprInvoiceExpenseToTransfer(
        FooErpInvoiceExpense $invoiceExpense,
        ?ErpInvoiceExpenseTransfer $invoiceExpenseTransfer = null
    ): ErpInvoiceExpenseTransfer {
        if ($invoiceExpenseTransfer === null) {
            $invoiceExpenseTransfer = new ErpInvoiceExpenseTransfer();
        }
        $invoiceExpenseTransfer->fromArray($invoiceExpense->toArray(), true);

        return $invoiceExpenseTransfer
            ->setAmount((new ErpInvoiceAmountTransfer())->fromArray($invoiceExpense->getFooErpInvoiceAmount()->toArray(), true))
            ->setUnitPrice((new ErpInvoiceAmountTransfer())->fromArray($invoiceExpense->getFooErpInvoiceAmountUnitPrice()->toArray(), true))
            ->setCreatedAt($this->convertDateTimeToTimestamp($invoiceExpense->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($invoiceExpense->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoice $erpInvoice
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function fromErpInvoiceToTransfer(
        FooErpInvoice $erpInvoice,
        ?ErpInvoiceTransfer $erpInvoiceTransfer = null
    ): ErpInvoiceTransfer {
        $addEntityItems = false;

        if ($erpInvoiceTransfer === null) {
            $erpInvoiceTransfer = new ErpInvoiceTransfer();
            $addEntityItems = true;
        }

        $erpInvoiceTransfer->fromArray($erpInvoice->toArray(), true);

        if ($addEntityItems) {
            foreach ($erpInvoice->getFooErpInvoiceItems() as $erpInvoiceItem) {
                $erpInvoiceTransfer->addInvoiceItem($this->fromEprInvoiceItemToTransfer($erpInvoiceItem));
            }
        }

        return $erpInvoiceTransfer
            ->setCompanyBusinessUnit($this->companyBusinessUnitFacade->getCompanyBusinessUnitById((new CompanyBusinessUnitTransfer())->setIdCompanyBusinessUnit($erpInvoice->getFkCompanyBusinessUnit())))
            ->setTotal((new ErpInvoiceAmountTransfer())->fromArray($erpInvoice->getFooErpInvoiceAmountToal()->toArray(), true))
            ->setBillingAddress((new ErpInvoiceAddressTransfer())->fromArray($erpInvoice->getFooErpInvoiceBillingAddress()->toArray(), true))
            ->setShippingAddress((new ErpInvoiceAddressTransfer())->fromArray($erpInvoice->getFooErpInvoiceShippingAddress()->toArray(), true))
            ->setShippingAddress($this->fromErpInvoiceAddressToTransfer($erpInvoice->getFooErpInvoiceShippingAddress()))
            ->setBillingAddress($this->fromErpInvoiceAddressToTransfer($erpInvoice->getFooErpInvoiceBillingAddress()))
            ->setInvoiceDate($this->convertDateTimeToTimestamp($erpInvoice->getInvoiceDate()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpInvoice->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpInvoice->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress $erpInvoiceAddress
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|null $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function fromErpInvoiceAddressToTransfer(
        FooErpInvoiceAddress $erpInvoiceAddress,
        ?ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer = null
    ): ErpInvoiceAddressTransfer {
        if ($erpInvoiceAddressTransfer === null) {
            $erpInvoiceAddressTransfer = new ErpInvoiceAddressTransfer();
        }

        $erpInvoiceAddressTransfer->fromArray($erpInvoiceAddress->toArray(), true);

        return $erpInvoiceAddressTransfer
            ->setCountry($this->fromCountryToTransfer($erpInvoiceAddress->getSpyCountry()))
            ->setCreatedAt($this->convertDateTimeToTimestamp($erpInvoiceAddress->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($erpInvoiceAddress->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount $erpInvoiceTotal
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function fromErpInvoiceAmountToTransfer(
        FooErpInvoiceAmount $erpInvoiceTotal,
        ?ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer = null
    ): ErpInvoiceAmountTransfer {
        if ($erpInvoiceAmountTransfer === null) {
            $erpInvoiceAmountTransfer = new ErpInvoiceAmountTransfer();
        }

        $erpInvoiceAmountTransfer->fromArray($erpInvoiceTotal->toArray(), true);

        return $erpInvoiceAmountTransfer
            ->setValue($erpInvoiceTotal->getValue())
            ->setTax($erpInvoiceTotal->getTax());
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
