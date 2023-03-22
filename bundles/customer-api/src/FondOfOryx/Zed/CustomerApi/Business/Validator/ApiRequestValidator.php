<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Validator;

use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ApiValidationErrorTransfer;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validation;

class ApiRequestValidator implements ApiRequestValidatorInterface
{
    /**
     * @var string
     */
    protected const KEY_EMAIL = 'email';

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        $apiData = $apiRequestTransfer->getApiDataOrFail()->getData();

        $apiValidationErrorTransfers = $this->assertRequiredField($apiData, static::KEY_EMAIL, []);

        return $this->assertValidEmail($apiData, static::KEY_EMAIL, $apiValidationErrorTransfers);
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
     * @param array<string, mixed> $data
     * @param string $field
     * @param array<\Generated\Shared\Transfer\ApiValidationErrorTransfer> $apiValidationErrorTransfers
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    protected function assertValidEmail(array $data, string $field, array $apiValidationErrorTransfers): array
    {
        if (isset($data[$field])) {
            $validator = Validation::createValidator();
            $violations = $validator->validate($data[$field], [
                new Email(),
            ]);

            if ($violations->count() === 0) {
                return $apiValidationErrorTransfers;
            }

            $messages = [];
            /** @var \Symfony\Component\Validator\ConstraintViolationInterface $violation */
            foreach ($violations as $violation) {
                $messages[] = (string)$violation->getMessage();
            }

            $apiValidationErrorTransfers[] = $this->createApiValidationErrorTransfer($field, $messages);
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
