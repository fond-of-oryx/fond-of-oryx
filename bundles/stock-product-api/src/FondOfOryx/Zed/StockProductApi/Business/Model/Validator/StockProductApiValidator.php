<?php

namespace FondOfOryx\Zed\StockProductApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class StockProductApiValidator implements StockProductApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer)
    {
        $data = $apiDataTransfer->getData();

        $errors = [];
        $errors = $this->assertRequiredField($data, 'sku', $errors);
        $errors = $this->assertRequiredField($data, 'stock_type', $errors);
        $errors = $this->assertRequiredField($data, 'quantity', $errors);
        $errors = $this->assertRequiredField($data, 'is_never_out_of_stock', $errors);

        return $errors;
    }

    /**
     * @param array $data
     * @param string $field
     * @param array $errors
     *
     * @return array
     */
    protected function assertRequiredField(array $data, $field, array $errors)
    {
        if (!isset($data[$field]) || !array_key_exists($field, $data)) {
            $message = sprintf('Missing value for required field "%s"', $field);
            $errors[$field][] = $message;
        }

        return $errors;
    }
}
