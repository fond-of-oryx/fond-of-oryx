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
class IndexDefinitionTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const INDEX_NAME = 'indexName';

    /**
     * @var string
     */
    public const SETTINGS = 'settings';

    /**
     * @var string
     */
    public const MAPPINGS = 'mappings';

    /**
     * @var string|null
     */
    protected $indexName;

    /**
     * @var array
     */
    protected $settings = [];

    /**
     * @var array
     */
    protected $mappings = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'index_name' => 'indexName',
        'indexName' => 'indexName',
        'IndexName' => 'indexName',
        'settings' => 'settings',
        'Settings' => 'settings',
        'mappings' => 'mappings',
        'Mappings' => 'mappings',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::INDEX_NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'index_name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SETTINGS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'settings',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::MAPPINGS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'mappings',
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
     * @param string|null $indexName
     *
     * @return $this
     */
    public function setIndexName($indexName)
    {
        $this->indexName = $indexName;
        $this->modifiedProperties[self::INDEX_NAME] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return string|null
     */
    public function getIndexName()
    {
        return $this->indexName;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param string|null $indexName
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIndexNameOrFail($indexName)
    {
        if ($indexName === null) {
            $this->throwNullValueException(static::INDEX_NAME);
        }

        return $this->setIndexName($indexName);
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getIndexNameOrFail()
    {
        if ($this->indexName === null) {
            $this->throwNullValueException(static::INDEX_NAME);
        }

        return $this->indexName;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIndexName()
    {
        $this->assertPropertyIsSet(self::INDEX_NAME);

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param array|null $settings
     *
     * @return $this
     */
    public function setSettings(array $settings = null)
    {
        if ($settings === null) {
            $settings = [];
        }

        $this->settings = $settings;
        $this->modifiedProperties[self::SETTINGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param mixed $setting
     *
     * @return $this
     */
    public function addSetting($setting)
    {
        $this->settings[] = $setting;
        $this->modifiedProperties[self::SETTINGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSettings()
    {
        $this->assertPropertyIsSet(self::SETTINGS);

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param array|null $mappings
     *
     * @return $this
     */
    public function setMappings(array $mappings = null)
    {
        if ($mappings === null) {
            $mappings = [];
        }

        $this->mappings = $mappings;
        $this->modifiedProperties[self::MAPPINGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return array
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param mixed $mapping
     *
     * @return $this
     */
    public function addMapping($mapping)
    {
        $this->mappings[] = $mapping;
        $this->modifiedProperties[self::MAPPINGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireMappings()
    {
        $this->assertPropertyIsSet(self::MAPPINGS);

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
                case 'indexName':
                case 'settings':
                case 'mappings':
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
                case 'indexName':
                case 'settings':
                case 'mappings':
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
                case 'indexName':
                case 'settings':
                case 'mappings':
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
            'indexName' => $this->indexName,
            'settings' => $this->settings,
            'mappings' => $this->mappings,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'index_name' => $this->indexName,
            'settings' => $this->settings,
            'mappings' => $this->mappings,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'index_name' => $this->indexName instanceof AbstractTransfer ? $this->indexName->toArray(true, false) : $this->indexName,
            'settings' => $this->settings instanceof AbstractTransfer ? $this->settings->toArray(true, false) : $this->settings,
            'mappings' => $this->mappings instanceof AbstractTransfer ? $this->mappings->toArray(true, false) : $this->mappings,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'indexName' => $this->indexName instanceof AbstractTransfer ? $this->indexName->toArray(true, true) : $this->indexName,
            'settings' => $this->settings instanceof AbstractTransfer ? $this->settings->toArray(true, true) : $this->settings,
            'mappings' => $this->mappings instanceof AbstractTransfer ? $this->mappings->toArray(true, true) : $this->mappings,
        ];
    }
}
