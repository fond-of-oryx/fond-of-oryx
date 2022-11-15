<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class FlashMessagesTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const SUCCESS_MESSAGES = 'successMessages';

    /**
     * @var string
     */
    public const ERROR_MESSAGES = 'errorMessages';

    /**
     * @var string
     */
    public const INFO_MESSAGES = 'infoMessages';

    /**
     * @var array
     */
    protected $successMessages = [];

    /**
     * @var array
     */
    protected $errorMessages = [];

    /**
     * @var array
     */
    protected $infoMessages = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'success_messages' => 'successMessages',
        'successMessages' => 'successMessages',
        'SuccessMessages' => 'successMessages',
        'error_messages' => 'errorMessages',
        'errorMessages' => 'errorMessages',
        'ErrorMessages' => 'errorMessages',
        'info_messages' => 'infoMessages',
        'infoMessages' => 'infoMessages',
        'InfoMessages' => 'infoMessages',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::SUCCESS_MESSAGES => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'success_messages',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ERROR_MESSAGES => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'error_messages',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::INFO_MESSAGES => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'info_messages',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];

    /**
     * @module Messenger|ZedRequest
     *
     * @param array|null $successMessages
     *
     * @return $this
     */
    public function setSuccessMessages(array $successMessages = null)
    {
        if ($successMessages === null) {
            $successMessages = [];
        }

        $this->successMessages = $successMessages;
        $this->modifiedProperties[self::SUCCESS_MESSAGES] = true;

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @return array
     */
    public function getSuccessMessages()
    {
        return $this->successMessages;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @param mixed $successMessage
     *
     * @return $this
     */
    public function addSuccessMessage($successMessage)
    {
        $this->successMessages[] = $successMessage;
        $this->modifiedProperties[self::SUCCESS_MESSAGES] = true;

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSuccessMessages()
    {
        $this->assertPropertyIsSet(self::SUCCESS_MESSAGES);

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @param array|null $errorMessages
     *
     * @return $this
     */
    public function setErrorMessages(array $errorMessages = null)
    {
        if ($errorMessages === null) {
            $errorMessages = [];
        }

        $this->errorMessages = $errorMessages;
        $this->modifiedProperties[self::ERROR_MESSAGES] = true;

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @param mixed $errorMessage
     *
     * @return $this
     */
    public function addErrorMessage($errorMessage)
    {
        $this->errorMessages[] = $errorMessage;
        $this->modifiedProperties[self::ERROR_MESSAGES] = true;

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireErrorMessages()
    {
        $this->assertPropertyIsSet(self::ERROR_MESSAGES);

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @param array|null $infoMessages
     *
     * @return $this
     */
    public function setInfoMessages(array $infoMessages = null)
    {
        if ($infoMessages === null) {
            $infoMessages = [];
        }

        $this->infoMessages = $infoMessages;
        $this->modifiedProperties[self::INFO_MESSAGES] = true;

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @return array
     */
    public function getInfoMessages()
    {
        return $this->infoMessages;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @param mixed $infoMessage
     *
     * @return $this
     */
    public function addInfoMessage($infoMessage)
    {
        $this->infoMessages[] = $infoMessage;
        $this->modifiedProperties[self::INFO_MESSAGES] = true;

        return $this;
    }

    /**
     * @module Messenger|ZedRequest
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireInfoMessages()
    {
        $this->assertPropertyIsSet(self::INFO_MESSAGES);

        return $this;
    }

    /**
     * @param array<string, mixed> $data
     * @param bool $ignoreMissingProperty
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function fromArray(array $data, $ignoreMissingProperty = false)
    {
        foreach ($data as $property => $value) {
            $normalizedPropertyName = $this->transferPropertyNameMap[$property] ?? null;

            switch ($normalizedPropertyName) {
                case 'successMessages':
                case 'errorMessages':
                case 'infoMessages':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                default:
                    if (!$ignoreMissingProperty) {
                        throw new \InvalidArgumentException(sprintf('Missing property `%s` in `%s`', $property, static::class));
                    }
            }
        }

        return $this;
    }

    /**
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    public function modifiedToArray($isRecursive = true, $camelCasedKeys = false): array
    {
        if ($isRecursive && !$camelCasedKeys) {
            return $this->modifiedToArrayRecursiveNotCamelCased();
        }
        if ($isRecursive && $camelCasedKeys) {
            return $this->modifiedToArrayRecursiveCamelCased();
        }
        if (!$isRecursive && $camelCasedKeys) {
            return $this->modifiedToArrayNotRecursiveCamelCased();
        }
        if (!$isRecursive && !$camelCasedKeys) {
            return $this->modifiedToArrayNotRecursiveNotCamelCased();
        }
    }

    /**
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    public function toArray($isRecursive = true, $camelCasedKeys = false): array
    {
        if ($isRecursive && !$camelCasedKeys) {
            return $this->toArrayRecursiveNotCamelCased();
        }
        if ($isRecursive && $camelCasedKeys) {
            return $this->toArrayRecursiveCamelCased();
        }
        if (!$isRecursive && !$camelCasedKeys) {
            return $this->toArrayNotRecursiveNotCamelCased();
        }
        if (!$isRecursive && $camelCasedKeys) {
            return $this->toArrayNotRecursiveCamelCased();
        }
    }

    /**
     * @param array<string, mixed>|\ArrayObject<string, mixed> $value
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    protected function addValuesToCollectionModified($value, $isRecursive, $camelCasedKeys): array
    {
        $result = [];
        foreach ($value as $elementKey => $arrayElement) {
            if ($arrayElement instanceof AbstractTransfer) {
                $result[$elementKey] = $arrayElement->modifiedToArray($isRecursive, $camelCasedKeys);

                continue;
            }
            $result[$elementKey] = $arrayElement;
        }

        return $result;
    }

    /**
     * @param array<string, mixed>|\ArrayObject<string, mixed> $value
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    protected function addValuesToCollection($value, $isRecursive, $camelCasedKeys): array
    {
        $result = [];
        foreach ($value as $elementKey => $arrayElement) {
            if ($arrayElement instanceof AbstractTransfer) {
                $result[$elementKey] = $arrayElement->toArray($isRecursive, $camelCasedKeys);

                continue;
            }
            $result[$elementKey] = $arrayElement;
        }

        return $result;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayRecursiveCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $property;

            if ($value instanceof AbstractTransfer) {
                $values[$arrayKey] = $value->modifiedToArray(true, true);

                continue;
            }
            switch ($property) {
                case 'successMessages':
                case 'errorMessages':
                case 'infoMessages':
                    $values[$arrayKey] = $value;

                    break;
            }
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayRecursiveNotCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $this->transferMetadata[$property]['name_underscore'];

            if ($value instanceof AbstractTransfer) {
                $values[$arrayKey] = $value->modifiedToArray(true, false);

                continue;
            }
            switch ($property) {
                case 'successMessages':
                case 'errorMessages':
                case 'infoMessages':
                    $values[$arrayKey] = $value;

                    break;
            }
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayNotRecursiveNotCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $this->transferMetadata[$property]['name_underscore'];

            $values[$arrayKey] = $value;
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayNotRecursiveCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $property;

            $values[$arrayKey] = $value;
        }

        return $values;
    }

    /**
     * @return void
     */
    protected function initCollectionProperties(): void
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'successMessages' => $this->successMessages,
            'errorMessages' => $this->errorMessages,
            'infoMessages' => $this->infoMessages,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'success_messages' => $this->successMessages,
            'error_messages' => $this->errorMessages,
            'info_messages' => $this->infoMessages,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'success_messages' => $this->successMessages instanceof AbstractTransfer ? $this->successMessages->toArray(true, false) : $this->successMessages,
            'error_messages' => $this->errorMessages instanceof AbstractTransfer ? $this->errorMessages->toArray(true, false) : $this->errorMessages,
            'info_messages' => $this->infoMessages instanceof AbstractTransfer ? $this->infoMessages->toArray(true, false) : $this->infoMessages,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'successMessages' => $this->successMessages instanceof AbstractTransfer ? $this->successMessages->toArray(true, true) : $this->successMessages,
            'errorMessages' => $this->errorMessages instanceof AbstractTransfer ? $this->errorMessages->toArray(true, true) : $this->errorMessages,
            'infoMessages' => $this->infoMessages instanceof AbstractTransfer ? $this->infoMessages->toArray(true, true) : $this->infoMessages,
        ];
    }
}
