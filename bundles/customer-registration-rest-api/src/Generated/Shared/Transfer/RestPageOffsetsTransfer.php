<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 *
 * @deprecated Will be removed without replacement.
 */
class RestPageOffsetsTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const LIMIT = 'limit';

    /**
     * @var string
     */
    public const FIRST_OFFSET = 'firstOffset';

    /**
     * @var string
     */
    public const LAST_OFFSET = 'lastOffset';

    /**
     * @var string
     */
    public const PREV_OFFSET = 'prevOffset';

    /**
     * @var string
     */
    public const NEXT_OFFSET = 'nextOffset';

    /**
     * @var int|null
     */
    protected $limit;

    /**
     * @var int|null
     */
    protected $firstOffset;

    /**
     * @var int|null
     */
    protected $lastOffset;

    /**
     * @var int|null
     */
    protected $prevOffset;

    /**
     * @var int|null
     */
    protected $nextOffset;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'limit' => 'limit',
        'Limit' => 'limit',
        'first_offset' => 'firstOffset',
        'firstOffset' => 'firstOffset',
        'FirstOffset' => 'firstOffset',
        'last_offset' => 'lastOffset',
        'lastOffset' => 'lastOffset',
        'LastOffset' => 'lastOffset',
        'prev_offset' => 'prevOffset',
        'prevOffset' => 'prevOffset',
        'PrevOffset' => 'prevOffset',
        'next_offset' => 'nextOffset',
        'nextOffset' => 'nextOffset',
        'NextOffset' => 'nextOffset',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::LIMIT => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'limit',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::FIRST_OFFSET => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'first_offset',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LAST_OFFSET => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'last_offset',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PREV_OFFSET => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'prev_offset',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::NEXT_OFFSET => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'next_offset',
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
     * @module GlueApplication
     *
     * @param int|null $limit
     *
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->modifiedProperties[self::LIMIT] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $limit
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLimitOrFail($limit)
    {
        if ($limit === null) {
            $this->throwNullValueException(static::LIMIT);
        }

        return $this->setLimit($limit);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getLimitOrFail()
    {
        if ($this->limit === null) {
            $this->throwNullValueException(static::LIMIT);
        }

        return $this->limit;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLimit()
    {
        $this->assertPropertyIsSet(self::LIMIT);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $firstOffset
     *
     * @return $this
     */
    public function setFirstOffset($firstOffset)
    {
        $this->firstOffset = $firstOffset;
        $this->modifiedProperties[self::FIRST_OFFSET] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getFirstOffset()
    {
        return $this->firstOffset;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $firstOffset
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setFirstOffsetOrFail($firstOffset)
    {
        if ($firstOffset === null) {
            $this->throwNullValueException(static::FIRST_OFFSET);
        }

        return $this->setFirstOffset($firstOffset);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getFirstOffsetOrFail()
    {
        if ($this->firstOffset === null) {
            $this->throwNullValueException(static::FIRST_OFFSET);
        }

        return $this->firstOffset;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFirstOffset()
    {
        $this->assertPropertyIsSet(self::FIRST_OFFSET);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $lastOffset
     *
     * @return $this
     */
    public function setLastOffset($lastOffset)
    {
        $this->lastOffset = $lastOffset;
        $this->modifiedProperties[self::LAST_OFFSET] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getLastOffset()
    {
        return $this->lastOffset;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $lastOffset
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLastOffsetOrFail($lastOffset)
    {
        if ($lastOffset === null) {
            $this->throwNullValueException(static::LAST_OFFSET);
        }

        return $this->setLastOffset($lastOffset);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getLastOffsetOrFail()
    {
        if ($this->lastOffset === null) {
            $this->throwNullValueException(static::LAST_OFFSET);
        }

        return $this->lastOffset;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLastOffset()
    {
        $this->assertPropertyIsSet(self::LAST_OFFSET);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $prevOffset
     *
     * @return $this
     */
    public function setPrevOffset($prevOffset)
    {
        $this->prevOffset = $prevOffset;
        $this->modifiedProperties[self::PREV_OFFSET] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getPrevOffset()
    {
        return $this->prevOffset;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $prevOffset
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPrevOffsetOrFail($prevOffset)
    {
        if ($prevOffset === null) {
            $this->throwNullValueException(static::PREV_OFFSET);
        }

        return $this->setPrevOffset($prevOffset);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getPrevOffsetOrFail()
    {
        if ($this->prevOffset === null) {
            $this->throwNullValueException(static::PREV_OFFSET);
        }

        return $this->prevOffset;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePrevOffset()
    {
        $this->assertPropertyIsSet(self::PREV_OFFSET);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $nextOffset
     *
     * @return $this
     */
    public function setNextOffset($nextOffset)
    {
        $this->nextOffset = $nextOffset;
        $this->modifiedProperties[self::NEXT_OFFSET] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getNextOffset()
    {
        return $this->nextOffset;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $nextOffset
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setNextOffsetOrFail($nextOffset)
    {
        if ($nextOffset === null) {
            $this->throwNullValueException(static::NEXT_OFFSET);
        }

        return $this->setNextOffset($nextOffset);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getNextOffsetOrFail()
    {
        if ($this->nextOffset === null) {
            $this->throwNullValueException(static::NEXT_OFFSET);
        }

        return $this->nextOffset;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireNextOffset()
    {
        $this->assertPropertyIsSet(self::NEXT_OFFSET);

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
                case 'limit':
                case 'firstOffset':
                case 'lastOffset':
                case 'prevOffset':
                case 'nextOffset':
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
                case 'limit':
                case 'firstOffset':
                case 'lastOffset':
                case 'prevOffset':
                case 'nextOffset':
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
                case 'limit':
                case 'firstOffset':
                case 'lastOffset':
                case 'prevOffset':
                case 'nextOffset':
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
            'limit' => $this->limit,
            'firstOffset' => $this->firstOffset,
            'lastOffset' => $this->lastOffset,
            'prevOffset' => $this->prevOffset,
            'nextOffset' => $this->nextOffset,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'limit' => $this->limit,
            'first_offset' => $this->firstOffset,
            'last_offset' => $this->lastOffset,
            'prev_offset' => $this->prevOffset,
            'next_offset' => $this->nextOffset,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'limit' => $this->limit instanceof AbstractTransfer ? $this->limit->toArray(true, false) : $this->limit,
            'first_offset' => $this->firstOffset instanceof AbstractTransfer ? $this->firstOffset->toArray(true, false) : $this->firstOffset,
            'last_offset' => $this->lastOffset instanceof AbstractTransfer ? $this->lastOffset->toArray(true, false) : $this->lastOffset,
            'prev_offset' => $this->prevOffset instanceof AbstractTransfer ? $this->prevOffset->toArray(true, false) : $this->prevOffset,
            'next_offset' => $this->nextOffset instanceof AbstractTransfer ? $this->nextOffset->toArray(true, false) : $this->nextOffset,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'limit' => $this->limit instanceof AbstractTransfer ? $this->limit->toArray(true, true) : $this->limit,
            'firstOffset' => $this->firstOffset instanceof AbstractTransfer ? $this->firstOffset->toArray(true, true) : $this->firstOffset,
            'lastOffset' => $this->lastOffset instanceof AbstractTransfer ? $this->lastOffset->toArray(true, true) : $this->lastOffset,
            'prevOffset' => $this->prevOffset instanceof AbstractTransfer ? $this->prevOffset->toArray(true, true) : $this->prevOffset,
            'nextOffset' => $this->nextOffset instanceof AbstractTransfer ? $this->nextOffset->toArray(true, true) : $this->nextOffset,
        ];
    }
}
