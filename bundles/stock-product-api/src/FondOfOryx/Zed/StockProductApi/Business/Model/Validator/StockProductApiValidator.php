<?php

namespace FondOfOryx\Zed\StockProductApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ApiValidationErrorTransfer;

class StockProductApiValidator implements StockProductApiValidatorInterface
{
    /**
     * @var string
     */
    protected const KEY_SKU = 'sku';

    /**
     * @var string
     */
    protected const KEY_STOCK_TYPE = 'stock_type';

    /**
     * @var string
     */
    protected const KEY_QUANTITY = 'quantity';

    /**
     * @var string
     */
    protected const KEY_IS_NEVER_OUT_OF_STOCK = 'is_never_out_of_stock';

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        $apiData = $apiRequestTransfer->getApiDataOrFail()->getData();

        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_SKU, []);
        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_STOCK_TYPE, $apiValidationErrorTransfers);
        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_QUANTITY, $apiValidationErrorTransfers);

        return $this->assertRequiredField($apiData, static::KEY_IS_NEVER_OUT_OF_STOCK, $apiValidationErrorTransfers);
    }

    /**
     * @param array<string, mixed> $data
     * @param string $field
     * @param array<\Generated\Shared\Transfer\ApiValidationErrorTransfer> $apiValidationErrorTransfers
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    protected function assertRequiredField(array $data, string $field, array $apiValidationErrorTransfers): array
    {
        if (!array_key_exists($field, $data)) {
            $message = sprintf('Missing value for required field "%s"', $field);
            $apiValidationErrorTransfers[] = $this->createApiValidationErrorTransfer($field, [$message]);
        }

        return $apiValidationErrorTransfers;
    }

    /**
     * @param string $field
     * @param array<string> $messages
     *
     * @return \Generated\Shared\Transfer\ApiValidationErrorTransfer
     */
    protected function createApiValidationErrorTransfer(string $field, array $messages): ApiValidationErrorTransfer
    {
        return (new ApiValidationErrorTransfer())
            ->setField($field)
            ->setMessages($messages);
    }
}
