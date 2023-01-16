<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ItemTransfer;

class MailjetTemplateVariablesItemsMapper implements MailjetTemplateVariablesTransferCollectionMapperInterface
{
    /**
     * @var string
     */
    public const IMAGE = 'image';

    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string
     */
    public const SKU = 'sku';

    /**
     * @var string
     */
    public const QUANTITY = 'quantity';

    /**
     * @var string
     */
    public const UNIT_PRICE = 'unitPrice';

    /**
     * @var string
     */
    public const SUM_PRICE = 'sumPrice';

    /**
     * @param \ArrayObject<(\Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\ItemTransfer)> $arrayObject
     *
     * @return array<array<string, mixed>>
     */
    public function map(ArrayObject $arrayObject): array
    {
        $items = [];

        /** @var \Generated\Shared\Transfer\ItemTransfer $itemTransfer */
        foreach ($arrayObject as $itemTransfer) {
            $items[] = $this->itemTransferToArray($itemTransfer);
        }

        return $items;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return array<string, mixed>
     */
    protected function itemTransferToArray(ItemTransfer $itemTransfer): array
    {
        return [
            static::IMAGE => $itemTransfer->getMetadata()->getImage(),
            static::NAME => $itemTransfer->getName(),
            static::SKU => $itemTransfer->getSku(),
            static::QUANTITY => $itemTransfer->getQuantity(),
            static::UNIT_PRICE => $itemTransfer->getUnitPrice(),
            static::SUM_PRICE => $itemTransfer->getSumPrice(),
        ];
    }
}
