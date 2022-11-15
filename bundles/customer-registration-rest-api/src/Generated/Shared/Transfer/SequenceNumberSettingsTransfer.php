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
class SequenceNumberSettingsTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const NAME = 'name';

    /**
     * @var string
     */
    public const PREFIX = 'prefix';

    /**
     * @var string
     */
    public const PADDING = 'padding';

    /**
     * @var string
     */
    public const OFFSET = 'offset';

    /**
     * @var string
     */
    public const INCREMENT_MINIMUM = 'incrementMinimum';

    /**
     * @var string
     */
    public const INCREMENT_MAXIMUM = 'incrementMaximum';

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $prefix;

    /**
     * @var int|null
     */
    protected $padding;

    /**
     * @var int|null
     */
    protected $offset;

    /**
     * @var int|null
     */
    protected $incrementMinimum;

    /**
     * @var int|null
     */
    protected $incrementMaximum;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'name' => 'name',
        'Name' => 'name',
        'prefix' => 'prefix',
        'Prefix' => 'prefix',
        'padding' => 'padding',
        'Padding' => 'padding',
        'offset' => 'offset',
        'Offset' => 'offset',
        'increment_minimum' => 'incrementMinimum',
        'incrementMinimum' => 'incrementMinimum',
        'IncrementMinimum' => 'incrementMinimum',
        'increment_maximum' => 'incrementMaximum',
        'incrementMaximum' => 'incrementMaximum',
        'IncrementMaximum' => 'incrementMaximum',
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
        self::PREFIX => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'prefix',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PADDING => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'padding',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::OFFSET => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'offset',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::INCREMENT_MINIMUM => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'increment_minimum',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::INCREMENT_MAXIMUM => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'increment_maximum',
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
     * @module Customer|SequenceNumber
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
     * @module Customer|SequenceNumber
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @module Customer|SequenceNumber
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
     * @module Customer|SequenceNumber
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
     * @module Customer|SequenceNumber
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
     * @module Customer|SequenceNumber
     *
     * @param string|null $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        $this->modifiedProperties[self::PREFIX] = true;

        return $this;
    }

    /**
     * @module Customer|SequenceNumber
     *
     * @return string|null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @module Customer|SequenceNumber
     *
     * @param string|null $prefix
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPrefixOrFail($prefix)
    {
        if ($prefix === null) {
            $this->throwNullValueException(static::PREFIX);
        }

        return $this->setPrefix($prefix);
    }

    /**
     * @module Customer|SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getPrefixOrFail()
    {
        if ($this->prefix === null) {
            $this->throwNullValueException(static::PREFIX);
        }

        return $this->prefix;
    }

    /**
     * @module Customer|SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePrefix()
    {
        $this->assertPropertyIsSet(self::PREFIX);

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $padding
     *
     * @return $this
     */
    public function setPadding($padding)
    {
        $this->padding = $padding;
        $this->modifiedProperties[self::PADDING] = true;

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @return int|null
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $padding
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPaddingOrFail($padding)
    {
        if ($padding === null) {
            $this->throwNullValueException(static::PADDING);
        }

        return $this->setPadding($padding);
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getPaddingOrFail()
    {
        if ($this->padding === null) {
            $this->throwNullValueException(static::PADDING);
        }

        return $this->padding;
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePadding()
    {
        $this->assertPropertyIsSet(self::PADDING);

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $offset
     *
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->modifiedProperties[self::OFFSET] = true;

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @return int|null
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $offset
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setOffsetOrFail($offset)
    {
        if ($offset === null) {
            $this->throwNullValueException(static::OFFSET);
        }

        return $this->setOffset($offset);
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getOffsetOrFail()
    {
        if ($this->offset === null) {
            $this->throwNullValueException(static::OFFSET);
        }

        return $this->offset;
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireOffset()
    {
        $this->assertPropertyIsSet(self::OFFSET);

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $incrementMinimum
     *
     * @return $this
     */
    public function setIncrementMinimum($incrementMinimum)
    {
        $this->incrementMinimum = $incrementMinimum;
        $this->modifiedProperties[self::INCREMENT_MINIMUM] = true;

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @return int|null
     */
    public function getIncrementMinimum()
    {
        return $this->incrementMinimum;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $incrementMinimum
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIncrementMinimumOrFail($incrementMinimum)
    {
        if ($incrementMinimum === null) {
            $this->throwNullValueException(static::INCREMENT_MINIMUM);
        }

        return $this->setIncrementMinimum($incrementMinimum);
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getIncrementMinimumOrFail()
    {
        if ($this->incrementMinimum === null) {
            $this->throwNullValueException(static::INCREMENT_MINIMUM);
        }

        return $this->incrementMinimum;
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIncrementMinimum()
    {
        $this->assertPropertyIsSet(self::INCREMENT_MINIMUM);

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $incrementMaximum
     *
     * @return $this
     */
    public function setIncrementMaximum($incrementMaximum)
    {
        $this->incrementMaximum = $incrementMaximum;
        $this->modifiedProperties[self::INCREMENT_MAXIMUM] = true;

        return $this;
    }

    /**
     * @module SequenceNumber
     *
     * @return int|null
     */
    public function getIncrementMaximum()
    {
        return $this->incrementMaximum;
    }

    /**
     * @module SequenceNumber
     *
     * @param int|null $incrementMaximum
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIncrementMaximumOrFail($incrementMaximum)
    {
        if ($incrementMaximum === null) {
            $this->throwNullValueException(static::INCREMENT_MAXIMUM);
        }

        return $this->setIncrementMaximum($incrementMaximum);
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getIncrementMaximumOrFail()
    {
        if ($this->incrementMaximum === null) {
            $this->throwNullValueException(static::INCREMENT_MAXIMUM);
        }

        return $this->incrementMaximum;
    }

    /**
     * @module SequenceNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIncrementMaximum()
    {
        $this->assertPropertyIsSet(self::INCREMENT_MAXIMUM);

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
                case 'prefix':
                case 'padding':
                case 'offset':
                case 'incrementMinimum':
                case 'incrementMaximum':
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
                case 'name':
                case 'prefix':
                case 'padding':
                case 'offset':
                case 'incrementMinimum':
                case 'incrementMaximum':
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
                case 'name':
                case 'prefix':
                case 'padding':
                case 'offset':
                case 'incrementMinimum':
                case 'incrementMaximum':
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
            'name' => $this->name,
            'prefix' => $this->prefix,
            'padding' => $this->padding,
            'offset' => $this->offset,
            'incrementMinimum' => $this->incrementMinimum,
            'incrementMaximum' => $this->incrementMaximum,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'name' => $this->name,
            'prefix' => $this->prefix,
            'padding' => $this->padding,
            'offset' => $this->offset,
            'increment_minimum' => $this->incrementMinimum,
            'increment_maximum' => $this->incrementMaximum,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'name' => $this->name instanceof AbstractTransfer ? $this->name->toArray(true, false) : $this->name,
            'prefix' => $this->prefix instanceof AbstractTransfer ? $this->prefix->toArray(true, false) : $this->prefix,
            'padding' => $this->padding instanceof AbstractTransfer ? $this->padding->toArray(true, false) : $this->padding,
            'offset' => $this->offset instanceof AbstractTransfer ? $this->offset->toArray(true, false) : $this->offset,
            'increment_minimum' => $this->incrementMinimum instanceof AbstractTransfer ? $this->incrementMinimum->toArray(true, false) : $this->incrementMinimum,
            'increment_maximum' => $this->incrementMaximum instanceof AbstractTransfer ? $this->incrementMaximum->toArray(true, false) : $this->incrementMaximum,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'name' => $this->name instanceof AbstractTransfer ? $this->name->toArray(true, true) : $this->name,
            'prefix' => $this->prefix instanceof AbstractTransfer ? $this->prefix->toArray(true, true) : $this->prefix,
            'padding' => $this->padding instanceof AbstractTransfer ? $this->padding->toArray(true, true) : $this->padding,
            'offset' => $this->offset instanceof AbstractTransfer ? $this->offset->toArray(true, true) : $this->offset,
            'incrementMinimum' => $this->incrementMinimum instanceof AbstractTransfer ? $this->incrementMinimum->toArray(true, true) : $this->incrementMinimum,
            'incrementMaximum' => $this->incrementMaximum instanceof AbstractTransfer ? $this->incrementMaximum->toArray(true, true) : $this->incrementMaximum,
        ];
    }
}
