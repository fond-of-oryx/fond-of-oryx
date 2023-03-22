<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ApiValidationErrorTransfer;

class CompanyUnitAddressApiValidator implements CompanyUnitAddressApiValidatorInterface
{
    /**
     * @var string
     */
    protected const KEY_ADDRESS_1 = 'address1';

    /**
     * @var string
     */
    protected const KEY_ZIP_CODE = 'zip_code';

    /**
     * @var string
     */
    protected const KEY_FK_COUNTY = 'fk_country';

    /**
     * @var string
     */
    protected const KEY_ISO_2_CODE = 'iso2_code';

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        $apiData = $apiRequestTransfer->getApiDataOrFail()->getData();

        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_ADDRESS_1, []);
        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_FK_COUNTY, $apiValidationErrorTransfers);
        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_ISO_2_CODE, $apiValidationErrorTransfers);

        return $this->assertRequiredField($apiData, static::KEY_ZIP_CODE, $apiValidationErrorTransfers);
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
        if (!isset($data[$field]) || (array_key_exists($field, $data) && !$data[$field])) {
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
