<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer;

use FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManagerInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class SalesOrderAddressWriter implements SalesOrderAddressWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManagerInterface $entityManager
     */
    public function __construct(CustomerAddressSalesConnectorEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function updateFkResourceCustomerAddressByAddress(AddressTransfer $addressTransfer): AddressTransfer
    {
        $idSalesOrderAddress = $addressTransfer->getIdSalesOrderAddress();
        $idCustomerAddress = $addressTransfer->getIdCustomerAddress();

        if ($idSalesOrderAddress === null || $idCustomerAddress === null) {
            return $addressTransfer;
        }

        $this->entityManager->updateFkResourceCustomerAddressForSalesOrderAddress(
            $idSalesOrderAddress,
            $idCustomerAddress,
        );

        return $addressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCustomerAddressByQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $addressTransfer = $quoteTransfer->getBillingAddress();

        if ($addressTransfer !== null) {
            $this->updateFkResourceCustomerAddressByAddress($addressTransfer);
        }

        $addressTransfer = $quoteTransfer->getShippingAddress();

        if ($addressTransfer !== null) {
            $this->updateFkResourceCustomerAddressByAddress($addressTransfer);
        }

        foreach ($quoteTransfer->getItems() as $item) {
            $shipmentTransfer = $item->getShipment();

            if ($shipmentTransfer === null || $shipmentTransfer->getShippingAddress() === null) {
                continue;
            }

            $this->updateFkResourceCustomerAddressByAddress($shipmentTransfer->getShippingAddress());
        }

        return $quoteTransfer;
    }
}
