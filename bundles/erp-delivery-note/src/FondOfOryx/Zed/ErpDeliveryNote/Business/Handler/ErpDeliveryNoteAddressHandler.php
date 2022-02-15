<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Exception\UnknownTypeException;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteAddressHandler implements ErpDeliveryNoteAddressHandlerInterface
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
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface
     */
    protected $erpDeliveryNoteAddressWriter;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface
     */
    protected $erpDeliveryNoteAddressReader;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface $erpDeliveryNoteAddressWriter
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface $erpDeliveryNoteAddressReader
     */
    public function __construct(
        ErpDeliveryNoteAddressWriterInterface $erpDeliveryNoteAddressWriter,
        ErpDeliveryNoteAddressReaderInterface $erpDeliveryNoteAddressReader
    ) {
        $this->erpDeliveryNoteAddressWriter = $erpDeliveryNoteAddressWriter;
        $this->erpDeliveryNoteAddressReader = $erpDeliveryNoteAddressReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param string $addressType
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @throws \FondOfOryx\Zed\ErpDeliveryNote\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function handle(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        string $addressType,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        if (in_array($addressType, static::KNOWN_TYPES, true) === false) {
            throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
        }

        $deliveryNoteAddressTransfer = $this->getAddressByType($erpDeliveryNoteTransfer, $addressType);
        if ($existingErpDeliveryNoteTransfer !== null) {
            $existingErpDeliveryNoteAddressTransfer = $this->getAddressByType($existingErpDeliveryNoteTransfer, $addressType);
            $deliveryNoteAddressTransfer->setIdErpDeliveryNoteAddress($existingErpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress());
        }

        if ($deliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress() !== null) {
            return $this->handleAddressByType($erpDeliveryNoteTransfer, $this->update($deliveryNoteAddressTransfer), $addressType);
        }

        return $this->handleAddressByType($erpDeliveryNoteTransfer, $this->create($deliveryNoteAddressTransfer), $addressType);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    protected function create(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        if ($erpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress() !== null) {
            throw new Exception('IdErpDeliveryNoteAddress for create ErpDeliveryNoteAddress has to be null!');
        }

        return $this->erpDeliveryNoteAddressWriter->create($erpDeliveryNoteAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    protected function update(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        $erpDeliveryNoteAddressTransfer->requireIdErpDeliveryNoteAddress();

        $address = $this->erpDeliveryNoteAddressReader->findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress($erpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress());
        $address->fromArray($erpDeliveryNoteAddressTransfer->modifiedToArray(), true);

        return $this->erpDeliveryNoteAddressWriter->update($address);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpDeliveryNote\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    protected function getAddressByType(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer, string $addressType): ErpDeliveryNoteAddressTransfer
    {
        $addressTransfer = null;

        if ($addressType === static::BILLING_TYPE) {
            $addressTransfer = $erpDeliveryNoteTransfer->getBillingAddress();
        }
        if ($addressType === static::SHIPPING_TYPE) {
            $addressTransfer = $erpDeliveryNoteTransfer->getShippingAddress();
        }

        if ($addressTransfer !== null) {
            return $addressTransfer;
        }

        throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpDeliveryNote\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    protected function handleAddressByType(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer,
        string $addressType
    ): ErpDeliveryNoteTransfer {
        if ($addressType === static::BILLING_TYPE) {
            return $erpDeliveryNoteTransfer
                ->setBillingAddress($erpDeliveryNoteAddressTransfer)
                ->setFkBillingAddress($erpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress());
        }
        if ($addressType === static::SHIPPING_TYPE) {
            return $erpDeliveryNoteTransfer
                ->setShippingAddress($erpDeliveryNoteAddressTransfer)
                ->setFkShippingAddress($erpDeliveryNoteAddressTransfer->getIdErpDeliveryNoteAddress());
        }

        throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
    }
}
