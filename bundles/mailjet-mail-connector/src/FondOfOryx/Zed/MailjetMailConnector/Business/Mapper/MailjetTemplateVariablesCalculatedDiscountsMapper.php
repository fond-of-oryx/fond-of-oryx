<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CalculatedDiscountTransfer;

class MailjetTemplateVariablesCalculatedDiscountsMapper implements MailjetTemplateVariablesTransferCollectionMapperInterface
{
    /**
     * @var string
     */
    public const DISPLAY_NAME = 'displayName';

    /**
     * @var string
     */
    public const VOUCHER_CODE = 'voucherCode';

    /**
     * @param \ArrayObject<(\Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\CalculatedDiscountTransfer)> $arrayObject
     *
     * @return array<array<string, mixed>>
     */
    public function map(ArrayObject $arrayObject): array
    {
        $calculatedDiscounts = [];

        /** @var \Generated\Shared\Transfer\CalculatedDiscountTransfer $calculatedDiscountTransfer */
        foreach ($arrayObject as $calculatedDiscountTransfer) {
            $calculatedDiscounts[] = $this->calculatedDiscountTransferToArray($calculatedDiscountTransfer);
        }

        return $calculatedDiscounts;
    }

    /**
     * @param \Generated\Shared\Transfer\CalculatedDiscountTransfer $calculatedDiscountTransfer
     *
     * @return array<string, mixed>
     */
    protected function calculatedDiscountTransferToArray(CalculatedDiscountTransfer $calculatedDiscountTransfer): array
    {
        return [
            static::DISPLAY_NAME => $calculatedDiscountTransfer->getDisplayName(),
            static::VOUCHER_CODE => $calculatedDiscountTransfer->getVoucherCode(),
        ];
    }
}
