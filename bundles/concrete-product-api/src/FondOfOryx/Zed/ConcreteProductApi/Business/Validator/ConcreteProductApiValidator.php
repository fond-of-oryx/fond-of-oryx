<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class ConcreteProductApiValidator implements ConcreteProductApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return [];
    }

    /**
     * @param array $data
     * @param string $field
     * @param array $errors
     *
     * @return array<string>
     */
    protected function assertRequiredField(array $data, string $field, array $errors): array
    {
        if (!isset($data[$field]) || (array_key_exists($field, $data) && !$data[$field])) {
            $message = sprintf('Missing value for required field "%s"', $field);
            $errors[$field][] = $message;
        }

        return $errors;
    }
}
