<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyUnitAddressApiValidator implements CompanyUnitAddressApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        $data = $apiDataTransfer->getData();

        $errors = $this->assertRequiredField($data, 'address1', []);
        $errors = $this->assertRequiredField($data, 'zip_code', $errors);
        $errors = $this->assertRequiredField($data, 'fk_country', $errors);

        return $this->assertRequiredField($data, 'iso2_code', $errors);
    }

    /**
     * @param array $data
     * @param string $field
     * @param array $errors
     *
     * @return array
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
