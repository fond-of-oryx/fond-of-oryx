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
class RedisConfigurationTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const DATA_SOURCE_NAMES = 'dataSourceNames';

    /**
     * @var string
     */
    public const CONNECTION_CREDENTIALS = 'connectionCredentials';

    /**
     * @var string
     */
    public const CLIENT_OPTIONS = 'clientOptions';

    /**
     * @var array
     */
    protected $dataSourceNames = [];

    /**
     * @var \Generated\Shared\Transfer\RedisCredentialsTransfer|null
     */
    protected $connectionCredentials;

    /**
     * @var array
     */
    protected $clientOptions = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'data_source_names' => 'dataSourceNames',
        'dataSourceNames' => 'dataSourceNames',
        'DataSourceNames' => 'dataSourceNames',
        'connection_credentials' => 'connectionCredentials',
        'connectionCredentials' => 'connectionCredentials',
        'ConnectionCredentials' => 'connectionCredentials',
        'client_options' => 'clientOptions',
        'clientOptions' => 'clientOptions',
        'ClientOptions' => 'clientOptions',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::DATA_SOURCE_NAMES => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'data_source_names',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CONNECTION_CREDENTIALS => [
            'type' => 'Generated\Shared\Transfer\RedisCredentialsTransfer',
            'type_shim' => null,
            'name_underscore' => 'connection_credentials',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CLIENT_OPTIONS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'client_options',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => true,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];

    /**
     * @module Redis
     *
     * @param array|null $dataSourceNames
     *
     * @return $this
     */
    public function setDataSourceNames(array $dataSourceNames = null)
    {
        if ($dataSourceNames === null) {
            $dataSourceNames = [];
        }

        $this->dataSourceNames = $dataSourceNames;
        $this->modifiedProperties[self::DATA_SOURCE_NAMES] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return array
     */
    public function getDataSourceNames()
    {
        return $this->dataSourceNames;
    }

    /**
     * @module Redis
     *
     * @param mixed $dataSourceNames
     *
     * @return $this
     */
    public function addDataSourceNames($dataSourceNames)
    {
        $this->dataSourceNames[] = $dataSourceNames;
        $this->modifiedProperties[self::DATA_SOURCE_NAMES] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDataSourceNames()
    {
        $this->assertPropertyIsSet(self::DATA_SOURCE_NAMES);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param \Generated\Shared\Transfer\RedisCredentialsTransfer|null $connectionCredentials
     *
     * @return $this
     */
    public function setConnectionCredentials(RedisCredentialsTransfer $connectionCredentials = null)
    {
        $this->connectionCredentials = $connectionCredentials;
        $this->modifiedProperties[self::CONNECTION_CREDENTIALS] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return \Generated\Shared\Transfer\RedisCredentialsTransfer|null
     */
    public function getConnectionCredentials()
    {
        return $this->connectionCredentials;
    }

    /**
     * @module Redis
     *
     * @param \Generated\Shared\Transfer\RedisCredentialsTransfer $connectionCredentials
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setConnectionCredentialsOrFail(RedisCredentialsTransfer $connectionCredentials)
    {
        return $this->setConnectionCredentials($connectionCredentials);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\RedisCredentialsTransfer
     */
    public function getConnectionCredentialsOrFail()
    {
        if ($this->connectionCredentials === null) {
            $this->throwNullValueException(static::CONNECTION_CREDENTIALS);
        }

        return $this->connectionCredentials;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireConnectionCredentials()
    {
        $this->assertPropertyIsSet(self::CONNECTION_CREDENTIALS);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param array $clientOptions
     *
     * @return $this
     */
    public function setClientOptions($clientOptions)
    {
        if ($clientOptions === null) {
            $clientOptions = [];
        }

        $this->clientOptions = $clientOptions;
        $this->modifiedProperties[self::CLIENT_OPTIONS] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return array
     */
    public function getClientOptions()
    {
        return $this->clientOptions;
    }

    /**
     * @module Redis
     *
     * @param string|int $clientOptionKey
     * @param mixed $clientOptionValue
     *
     * @return $this
     */
    public function addClientOption($clientOptionKey, $clientOptionValue)
    {
        $this->clientOptions[$clientOptionKey] = $clientOptionValue;
        $this->modifiedProperties[self::CLIENT_OPTIONS] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireClientOptions()
    {
        $this->assertPropertyIsSet(self::CLIENT_OPTIONS);

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
                case 'dataSourceNames':
                case 'clientOptions':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'connectionCredentials':
                    if (is_array($value)) {
                        $type = $this->transferMetadata[$normalizedPropertyName]['type'];
                        /** @var \Spryker\Shared\Kernel\Transfer\TransferInterface $value */
                        $value = (new $type())->fromArray($value, $ignoreMissingProperty);
                    }

                    if ($value !== null && $this->isPropertyStrict($normalizedPropertyName)) {
                        $this->assertInstanceOfTransfer($normalizedPropertyName, $value);
                    }
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
                case 'dataSourceNames':
                case 'clientOptions':
                    $values[$arrayKey] = $value;

                    break;
                case 'connectionCredentials':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

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
                case 'dataSourceNames':
                case 'clientOptions':
                    $values[$arrayKey] = $value;

                    break;
                case 'connectionCredentials':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

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
            'dataSourceNames' => $this->dataSourceNames,
            'clientOptions' => $this->clientOptions,
            'connectionCredentials' => $this->connectionCredentials,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'data_source_names' => $this->dataSourceNames,
            'client_options' => $this->clientOptions,
            'connection_credentials' => $this->connectionCredentials,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'data_source_names' => $this->dataSourceNames instanceof AbstractTransfer ? $this->dataSourceNames->toArray(true, false) : $this->dataSourceNames,
            'client_options' => $this->clientOptions instanceof AbstractTransfer ? $this->clientOptions->toArray(true, false) : $this->clientOptions,
            'connection_credentials' => $this->connectionCredentials instanceof AbstractTransfer ? $this->connectionCredentials->toArray(true, false) : $this->connectionCredentials,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'dataSourceNames' => $this->dataSourceNames instanceof AbstractTransfer ? $this->dataSourceNames->toArray(true, true) : $this->dataSourceNames,
            'clientOptions' => $this->clientOptions instanceof AbstractTransfer ? $this->clientOptions->toArray(true, true) : $this->clientOptions,
            'connectionCredentials' => $this->connectionCredentials instanceof AbstractTransfer ? $this->connectionCredentials->toArray(true, true) : $this->connectionCredentials,
        ];
    }
}
