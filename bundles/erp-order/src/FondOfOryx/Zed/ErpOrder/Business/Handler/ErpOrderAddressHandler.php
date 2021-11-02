<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Exception;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriterInterface;
use FondOfOryx\Zed\ErpOrder\Exception\UnknownTypeException;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderAddressHandler implements ErpOrderAddressHandlerInterface
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
    protected const BILLING_TYPE = 'billingAddress';

    /**
     * @var string
     */
    protected const SHIPPING_TYPE = 'shippingAddress';

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriterInterface
     */
    protected $erpOrderAddressWriter;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface
     */
    protected $erpOrderAddressReader;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriterInterface $erpOrderAddressWriter
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface $erpOrderAddressReader
     */
    public function __construct(
        ErpOrderAddressWriterInterface $erpOrderAddressWriter,
        ErpOrderAddressReaderInterface $erpOrderAddressReader
    ) {
        $this->erpOrderAddressWriter = $erpOrderAddressWriter;
        $this->erpOrderAddressReader = $erpOrderAddressReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpOrder\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer, string $addressType): ErpOrderTransfer
    {
        if (in_array($addressType, static::KNOWN_TYPES, true) === false) {
            throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
        }

        $orderAddressTransfer = $this->getAddressByType($erpOrderTransfer, $addressType);

        if ($orderAddressTransfer->getIdErpOrderAddress() !== null) {
            return $this->handleAddressByType($erpOrderTransfer, $this->update($orderAddressTransfer), $addressType);
        }

        return $this->handleAddressByType($erpOrderTransfer, $this->create($orderAddressTransfer), $addressType);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    protected function create(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        if ($erpOrderAddressTransfer->getIdErpOrderAddress() !== null) {
            throw new Exception('IdErpOrderAddress for create ErpOrderAddress has to be null!');
        }

        return $this->erpOrderAddressWriter->create($erpOrderAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    protected function update(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        $erpOrderAddressTransfer->requireIdErpOrderAddress();

        $address = $this->erpOrderAddressReader->findErpOrderAddressByIdErpOrderAddress($erpOrderAddressTransfer->getIdErpOrderAddress());
        $address->fromArray($erpOrderAddressTransfer->toArray(), true);

        return $this->erpOrderAddressWriter->update($address);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpOrder\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    protected function getAddressByType(ErpOrderTransfer $erpOrderTransfer, string $addressType): ErpOrderAddressTransfer
    {
        $addressTransfer = null;

        if ($addressType === static::BILLING_TYPE) {
            $addressTransfer = $erpOrderTransfer->getBillingAddress();
        }
        if ($addressType === static::SHIPPING_TYPE) {
            $addressTransfer = $erpOrderTransfer->getShippingAddress();
        }

        if ($addressTransfer !== null) {
            return $addressTransfer;
        }

        throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     * @param string $addressType
     *
     * @throws \FondOfOryx\Zed\ErpOrder\Exception\UnknownTypeException
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    protected function handleAddressByType(
        ErpOrderTransfer $erpOrderTransfer,
        ErpOrderAddressTransfer $erpOrderAddressTransfer,
        string $addressType
    ): ErpOrderTransfer {
        if ($addressType === static::BILLING_TYPE) {
            return $erpOrderTransfer
                ->setBillingAddress($erpOrderAddressTransfer)
                ->setFkBillingAddress($erpOrderAddressTransfer->getIdErpOrderAddress());
        }
        if ($addressType === static::SHIPPING_TYPE) {
            return $erpOrderTransfer
                ->setShippingAddress($erpOrderAddressTransfer)
                ->setFkShippingAddress($erpOrderAddressTransfer->getIdErpOrderAddress());
        }

        throw new UnknownTypeException(sprintf('Type "%s" not known or address is null!', $addressType));
    }
}
