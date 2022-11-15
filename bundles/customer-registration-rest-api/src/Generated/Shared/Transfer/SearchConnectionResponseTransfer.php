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
class SearchConnectionResponseTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const IS_SUCCESSFULL = 'isSuccessfull';

    /**
     * @var string
     */
    public const RAW_RESPONSE = 'rawResponse';

    /**
     * @var bool|null
     */
    protected $isSuccessfull;

    /**
     * @var array
     */
    protected $rawResponse = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'is_successfull' => 'isSuccessfull',
        'isSuccessfull' => 'isSuccessfull',
        'IsSuccessfull' => 'isSuccessfull',
        'raw_response' => 'rawResponse',
        'rawResponse' => 'rawResponse',
        'RawResponse' => 'rawResponse',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::IS_SUCCESSFULL => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'is_successfull',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::RAW_RESPONSE => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'raw_response',
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
     * @module SearchElasticsearch
     *
     * @param bool|null $isSuccessfull
     *
     * @return $this
     */
    public function setIsSuccessfull($isSuccessfull)
    {
        $this->isSuccessfull = $isSuccessfull;
        $this->modifiedProperties[self::IS_SUCCESSFULL] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return bool|null
     */
    public function getIsSuccessfull()
    {
        return $this->isSuccessfull;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param bool|null $isSuccessfull
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIsSuccessfullOrFail($isSuccessfull)
    {
        if ($isSuccessfull === null) {
            $this->throwNullValueException(static::IS_SUCCESSFULL);
        }

        return $this->setIsSuccessfull($isSuccessfull);
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getIsSuccessfullOrFail()
    {
        if ($this->isSuccessfull === null) {
            $this->throwNullValueException(static::IS_SUCCESSFULL);
        }

        return $this->isSuccessfull;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIsSuccessfull()
    {
        $this->assertPropertyIsSet(self::IS_SUCCESSFULL);

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param array|null $rawResponse
     *
     * @return $this
     */
    public function setRawResponse(array $rawResponse = null)
    {
        if ($rawResponse === null) {
            $rawResponse = [];
        }

        $this->rawResponse = $rawResponse;
        $this->modifiedProperties[self::RAW_RESPONSE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return array
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param mixed $rawResponse
     *
     * @return $this
     */
    public function addRawResponse($rawResponse)
    {
        $this->rawResponse[] = $rawResponse;
        $this->modifiedProperties[self::RAW_RESPONSE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireRawResponse()
    {
        $this->assertPropertyIsSet(self::RAW_RESPONSE);

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
                case 'isSuccessfull':
                case 'rawResponse':
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
                case 'isSuccessfull':
                case 'rawResponse':
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
                case 'isSuccessfull':
                case 'rawResponse':
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
            'isSuccessfull' => $this->isSuccessfull,
            'rawResponse' => $this->rawResponse,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'is_successfull' => $this->isSuccessfull,
            'raw_response' => $this->rawResponse,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'is_successfull' => $this->isSuccessfull instanceof AbstractTransfer ? $this->isSuccessfull->toArray(true, false) : $this->isSuccessfull,
            'raw_response' => $this->rawResponse instanceof AbstractTransfer ? $this->rawResponse->toArray(true, false) : $this->rawResponse,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'isSuccessfull' => $this->isSuccessfull instanceof AbstractTransfer ? $this->isSuccessfull->toArray(true, true) : $this->isSuccessfull,
            'rawResponse' => $this->rawResponse instanceof AbstractTransfer ? $this->rawResponse->toArray(true, true) : $this->rawResponse,
        ];
    }
}
