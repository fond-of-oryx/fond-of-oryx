<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use ArrayObject;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class FacetSearchResultTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string
     */
    public const DOC_COUNT = 'docCount';

    /**
     * @var string
     */
    public const VALUES = 'values';

    /**
     * @var string
     */
    public const ACTIVE_VALUE = 'activeValue';

    /**
     * @var string
     */
    public const CONFIG = 'config';

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $docCount;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\FacetSearchResultValueTransfer[]
     */
    protected $values;

    /**
     * @var string|null
     */
    protected $activeValue;

    /**
     * @var \Generated\Shared\Transfer\FacetConfigTransfer|null
     */
    protected $config;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'name' => 'name',
        'Name' => 'name',
        'doc_count' => 'docCount',
        'docCount' => 'docCount',
        'DocCount' => 'docCount',
        'values' => 'values',
        'Values' => 'values',
        'active_value' => 'activeValue',
        'activeValue' => 'activeValue',
        'ActiveValue' => 'activeValue',
        'config' => 'config',
        'Config' => 'config',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::DOC_COUNT => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'doc_count',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::VALUES => [
            'type' => 'Generated\Shared\Transfer\FacetSearchResultValueTransfer',
            'type_shim' => null,
            'name_underscore' => 'values',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ACTIVE_VALUE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'active_value',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CONFIG => [
            'type' => 'Generated\Shared\Transfer\FacetConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'config',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->modifiedProperties[self::NAME] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $name
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setNameOrFail($name)
    {
        if ($name === null) {
            $this->throwNullValueException(static::NAME);
        }

        return $this->setName($name);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getNameOrFail()
    {
        if ($this->name === null) {
            $this->throwNullValueException(static::NAME);
        }

        return $this->name;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireName()
    {
        $this->assertPropertyIsSet(self::NAME);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $docCount
     *
     * @return $this
     */
    public function setDocCount($docCount)
    {
        $this->docCount = $docCount;
        $this->modifiedProperties[self::DOC_COUNT] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return int|null
     */
    public function getDocCount()
    {
        return $this->docCount;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $docCount
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDocCountOrFail($docCount)
    {
        if ($docCount === null) {
            $this->throwNullValueException(static::DOC_COUNT);
        }

        return $this->setDocCount($docCount);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getDocCountOrFail()
    {
        if ($this->docCount === null) {
            $this->throwNullValueException(static::DOC_COUNT);
        }

        return $this->docCount;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDocCount()
    {
        $this->assertPropertyIsSet(self::DOC_COUNT);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\FacetSearchResultValueTransfer[] $values
     *
     * @return $this
     */
    public function setValues(ArrayObject $values)
    {
        $this->values = $values;
        $this->modifiedProperties[self::VALUES] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FacetSearchResultValueTransfer[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\FacetSearchResultValueTransfer $value
     *
     * @return $this
     */
    public function addValue(FacetSearchResultValueTransfer $value)
    {
        $this->values[] = $value;
        $this->modifiedProperties[self::VALUES] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireValues()
    {
        $this->assertCollectionPropertyIsSet(self::VALUES);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $activeValue
     *
     * @return $this
     */
    public function setActiveValue($activeValue)
    {
        $this->activeValue = $activeValue;
        $this->modifiedProperties[self::ACTIVE_VALUE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return string|null
     */
    public function getActiveValue()
    {
        return $this->activeValue;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $activeValue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setActiveValueOrFail($activeValue)
    {
        if ($activeValue === null) {
            $this->throwNullValueException(static::ACTIVE_VALUE);
        }

        return $this->setActiveValue($activeValue);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getActiveValueOrFail()
    {
        if ($this->activeValue === null) {
            $this->throwNullValueException(static::ACTIVE_VALUE);
        }

        return $this->activeValue;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireActiveValue()
    {
        $this->assertPropertyIsSet(self::ACTIVE_VALUE);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\FacetConfigTransfer|null $config
     *
     * @return $this
     */
    public function setConfig(FacetConfigTransfer $config = null)
    {
        $this->config = $config;
        $this->modifiedProperties[self::CONFIG] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return \Generated\Shared\Transfer\FacetConfigTransfer|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\FacetConfigTransfer $config
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setConfigOrFail(FacetConfigTransfer $config)
    {
        return $this->setConfig($config);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\FacetConfigTransfer
     */
    public function getConfigOrFail()
    {
        if ($this->config === null) {
            $this->throwNullValueException(static::CONFIG);
        }

        return $this->config;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireConfig()
    {
        $this->assertPropertyIsSet(self::CONFIG);

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
                case 'name':
                case 'docCount':
                case 'activeValue':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'config':
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
                case 'values':
                    $elementType = $this->transferMetadata[$normalizedPropertyName]['type'];
                    $this->$normalizedPropertyName = $this->processArrayObject($elementType, $value, $ignoreMissingProperty);
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
                case 'name':
                case 'docCount':
                case 'activeValue':
                    $values[$arrayKey] = $value;

                    break;
                case 'config':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

                    break;
                case 'values':
                    $values[$arrayKey] = $value ? $this->addValuesToCollectionModified($value, true, true) : $value;

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
                case 'name':
                case 'docCount':
                case 'activeValue':
                    $values[$arrayKey] = $value;

                    break;
                case 'config':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

                    break;
                case 'values':
                    $values[$arrayKey] = $value ? $this->addValuesToCollectionModified($value, true, false) : $value;

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
        $this->values = $this->values ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'name' => $this->name,
            'docCount' => $this->docCount,
            'activeValue' => $this->activeValue,
            'config' => $this->config,
            'values' => $this->values,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'name' => $this->name,
            'doc_count' => $this->docCount,
            'active_value' => $this->activeValue,
            'config' => $this->config,
            'values' => $this->values,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'name' => $this->name instanceof AbstractTransfer ? $this->name->toArray(true, false) : $this->name,
            'doc_count' => $this->docCount instanceof AbstractTransfer ? $this->docCount->toArray(true, false) : $this->docCount,
            'active_value' => $this->activeValue instanceof AbstractTransfer ? $this->activeValue->toArray(true, false) : $this->activeValue,
            'config' => $this->config instanceof AbstractTransfer ? $this->config->toArray(true, false) : $this->config,
            'values' => $this->values instanceof AbstractTransfer ? $this->values->toArray(true, false) : $this->addValuesToCollection($this->values, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'name' => $this->name instanceof AbstractTransfer ? $this->name->toArray(true, true) : $this->name,
            'docCount' => $this->docCount instanceof AbstractTransfer ? $this->docCount->toArray(true, true) : $this->docCount,
            'activeValue' => $this->activeValue instanceof AbstractTransfer ? $this->activeValue->toArray(true, true) : $this->activeValue,
            'config' => $this->config instanceof AbstractTransfer ? $this->config->toArray(true, true) : $this->config,
            'values' => $this->values instanceof AbstractTransfer ? $this->values->toArray(true, true) : $this->addValuesToCollection($this->values, true, true),
        ];
    }
}
