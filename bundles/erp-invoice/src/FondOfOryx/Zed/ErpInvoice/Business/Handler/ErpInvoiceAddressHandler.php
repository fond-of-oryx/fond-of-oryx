<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use Exception;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriterInterface;
use FondOfOryx\Zed\ErpInvoice\Exception\UnknownTypeException;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceAddressHandler implements ErpInvoiceAddressHandlerInterface
{
    /**
     * @var array
     */
    public const KNOWN_TYPES = [
        self::BILLING_TYPE,
        self::SHIPPING_TYPE,
    ];

    /**
     * @var string
     */
    public const BILLING_TYPE = 'billingAddress';

    /**
     * @var string
     */
    public const SHIPPING_TYPE = 'shippingAddress';

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriterInterface
     */
    protected $erpInvoiceAddressWriter;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface
     */
    protected $erpInvoiceAddressReader;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriterInterface $erpInvoiceAddressWriter
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface $erpInvoiceAddressReader
     */
    public function __construct(
        ErpInvoiceAddressWriterInterface $erpInvoiceAddressWriter,
        ErpInvoiceAddressReaderInterface $erpInvoiceAddressReader
    ) {
        $this->erpInvoiceAddressWriter = $erpInvoiceAddressWriter;
        $this->erpInvoiceAddressReader = $erpInvoiceAddressReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param string $addressType
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @throws \FondOfOryx\Zed\ErpInvoice\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function handle(
        ErpInvoiceTransfer $erpInvoiceTransfer,
        string $addressType,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceTransfer {
        if (in_array($addressType, static::KNOWN_TYPES, true) === false) {
            throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
        }

        $invoiceAddressTransfer = $this->getAddressByType($erpInvoiceTransfer, $addressType);
        if ($existingErpInvoiceTransfer !== null) {
            $existingErpInvoiceAddressTransfer = $this->getAddressByType($existingErpInvoiceTransfer, $addressType);
            $invoiceAddressTransfer->setIdErpInvoiceAddress($existingErpInvoiceAddressTransfer->getIdErpInvoiceAddress());
        }

        if ($invoiceAddressTransfer->getIdErpInvoiceAddress() !== null) {
            return $this->handleAddressByType($erpInvoiceTransfer, $this->update($invoiceAddressTransfer), $addressType);
        }

        return $this->handleAddressByType($erpInvoiceTransfer, $this->create($invoiceAddressTransfer), $addressType);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    protected function create(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        if ($erpInvoiceAddressTransfer->getIdErpInvoiceAddress() !== null) {
            throw new Exception('IdErpInvoiceAddress for create ErpInvoiceAddress has to be null!');
        }

        return $this->erpInvoiceAddressWriter->create($erpInvoiceAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    protected function update(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        $erpInvoiceAddressTransfer->requireIdErpInvoiceAddress();

        $address = $this->erpInvoiceAddressReader->findErpInvoiceAddressByIdErpInvoiceAddress($erpInvoiceAddressTransfer->getIdErpInvoiceAddress());
        $address->fromArray($erpInvoiceAddressTransfer->modifiedToArray(), true);

        return $this->erpInvoiceAddressWriter->update($address);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpInvoice\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    protected function getAddressByType(ErpInvoiceTransfer $erpInvoiceTransfer, string $addressType): ErpInvoiceAddressTransfer
    {
        $addressTransfer = null;

        if ($addressType === static::BILLING_TYPE) {
            $addressTransfer = $erpInvoiceTransfer->getBillingAddress();
        }
        if ($addressType === static::SHIPPING_TYPE) {
            $addressTransfer = $erpInvoiceTransfer->getShippingAddress();
        }

        if ($addressTransfer !== null) {
            return $addressTransfer;
        }

        throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpInvoice\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    protected function handleAddressByType(
        ErpInvoiceTransfer $erpInvoiceTransfer,
        ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer,
        string $addressType
    ): ErpInvoiceTransfer {
        if ($addressType === static::BILLING_TYPE) {
            return $erpInvoiceTransfer
                ->setBillingAddress($erpInvoiceAddressTransfer)
                ->setFkBillingAddress($erpInvoiceAddressTransfer->getIdErpInvoiceAddress());
        }
        if ($addressType === static::SHIPPING_TYPE) {
            return $erpInvoiceTransfer
                ->setShippingAddress($erpInvoiceAddressTransfer)
                ->setFkShippingAddress($erpInvoiceAddressTransfer->getIdErpInvoiceAddress());
        }

        throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
    }
}
