<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer;

use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManagerInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class SalesOrderAddressWriter implements SalesOrderAddressWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CompanyUnitAddressSalesConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function updateFkResourceCompanyUnitAddressByAddress(AddressTransfer $addressTransfer): AddressTransfer
    {
        $idSalesOrderAddress = $addressTransfer->getIdSalesOrderAddress();
        $idCompanyUnitAddress = $addressTransfer->getIdCompanyUnitAddress();
        $idCustomerAddress = $addressTransfer->getIdCustomerAddress();

        if ($idSalesOrderAddress === null || $idCompanyUnitAddress === null || $idCustomerAddress !== null) {
            return $addressTransfer;
        }

        $this->entityManager->updateFkResourceCompanyUnitAddressForSalesOrderAddress(
            $idSalesOrderAddress,
            $idCompanyUnitAddress,
        );

        return $addressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCompanyUnitAddressByQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $addressTransfer = $quoteTransfer->getBillingAddress();

        if ($addressTransfer !== null) {
            $this->updateFkResourceCompanyUnitAddressByAddress($addressTransfer);
        }

        $addressTransfer = $quoteTransfer->getShippingAddress();

        if ($addressTransfer !== null) {
            $this->updateFkResourceCompanyUnitAddressByAddress($addressTransfer);
        }

        foreach ($quoteTransfer->getItems() as $item) {
            $shipmentTransfer = $item->getShipment();

            if ($shipmentTransfer === null || $shipmentTransfer->getShippingAddress() === null) {
                continue;
            }

            $this->updateFkResourceCompanyUnitAddressByAddress($shipmentTransfer->getShippingAddress());
        }

        return $quoteTransfer;
    }
}
