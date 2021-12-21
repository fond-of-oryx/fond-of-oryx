<?php

namespace FondOfOryx\Zed\CompanyApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyApiValidator implements CompanyApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        $data = $apiDataTransfer->getData();

        return $this->assertNonEmptyString($data, 'name', []);
    }

    /**
     * @param array $data
     * @param string $field
     * @param array $errors
     *
     * @return array
     */
    protected function assertNonEmptyString(array $data, string $field, array $errors): array
    {
        $errors = $this->assertRequired($data, $field, $errors);

        if (isset($errors[$field]) && is_array($errors[$field]) && count($errors[$field]) > 0) {
            return $errors;
        }

        if (trim($data[$field]) === '') {
            $errors[$field][] = sprintf('Field "%s" is empty.', $field);
        }

        return $errors;
    }

    /**
     * @param array $data
     * @param string $field
     * @param array $errors
     *
     * @return array
     */
    protected function assertRequired(array $data, string $field, array $errors): array
    {
        if (!isset($data[$field])) {
            $errors[$field][] = sprintf('Missing value for required field "%s"', $field);
        }

        return $errors;
    }
}
