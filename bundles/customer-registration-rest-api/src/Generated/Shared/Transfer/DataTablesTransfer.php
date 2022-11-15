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
class DataTablesTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const DRAW = 'draw';

    /**
     * @var string
     */
    public const COLUMNS = 'columns';

    /**
     * @var string
     */
    public const ORDER = 'order';

    /**
     * @var string
     */
    public const START = 'start';

    /**
     * @var string
     */
    public const LENGTH = 'length';

    /**
     * @var string
     */
    public const SEARCH = 'search';

    /**
     * @var int|null
     */
    protected $draw;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\DataTablesColumnTransfer[]
     */
    protected $columns;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\DataTablesOrderTransfer[]
     */
    protected $order;

    /**
     * @var int|null
     */
    protected $start;

    /**
     * @var int|null
     */
    protected $length;

    /**
     * @var array
     */
    protected $search = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'draw' => 'draw',
        'Draw' => 'draw',
        'columns' => 'columns',
        'Columns' => 'columns',
        'order' => 'order',
        'Order' => 'order',
        'start' => 'start',
        'Start' => 'start',
        'length' => 'length',
        'Length' => 'length',
        'search' => 'search',
        'Search' => 'search',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::DRAW => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'draw',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::COLUMNS => [
            'type' => 'Generated\Shared\Transfer\DataTablesColumnTransfer',
            'type_shim' => null,
            'name_underscore' => 'columns',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ORDER => [
            'type' => 'Generated\Shared\Transfer\DataTablesOrderTransfer',
            'type_shim' => null,
            'name_underscore' => 'order',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::START => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'start',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LENGTH => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'length',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SEARCH => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'search',
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
     * @module Gui
     *
     * @param int|null $draw
     *
     * @return $this
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
        $this->modifiedProperties[self::DRAW] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @return int|null
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @module Gui
     *
     * @param int|null $draw
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDrawOrFail($draw)
    {
        if ($draw === null) {
            $this->throwNullValueException(static::DRAW);
        }

        return $this->setDraw($draw);
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getDrawOrFail()
    {
        if ($this->draw === null) {
            $this->throwNullValueException(static::DRAW);
        }

        return $this->draw;
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDraw()
    {
        $this->assertPropertyIsSet(self::DRAW);

        return $this;
    }

    /**
     * @module Gui
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\DataTablesColumnTransfer[] $columns
     *
     * @return $this
     */
    public function setColumns(ArrayObject $columns)
    {
        $this->columns = $columns;
        $this->modifiedProperties[self::COLUMNS] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\DataTablesColumnTransfer[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @module Gui
     *
     * @param \Generated\Shared\Transfer\DataTablesColumnTransfer $columns
     *
     * @return $this
     */
    public function addColumns(DataTablesColumnTransfer $columns)
    {
        $this->columns[] = $columns;
        $this->modifiedProperties[self::COLUMNS] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireColumns()
    {
        $this->assertCollectionPropertyIsSet(self::COLUMNS);

        return $this;
    }

    /**
     * @module Gui
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\DataTablesOrderTransfer[] $order
     *
     * @return $this
     */
    public function setOrder(ArrayObject $order)
    {
        $this->order = $order;
        $this->modifiedProperties[self::ORDER] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\DataTablesOrderTransfer[]
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @module Gui
     *
     * @param \Generated\Shared\Transfer\DataTablesOrderTransfer $order
     *
     * @return $this
     */
    public function addOrder(DataTablesOrderTransfer $order)
    {
        $this->order[] = $order;
        $this->modifiedProperties[self::ORDER] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireOrder()
    {
        $this->assertCollectionPropertyIsSet(self::ORDER);

        return $this;
    }

    /**
     * @module Gui
     *
     * @param int|null $start
     *
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;
        $this->modifiedProperties[self::START] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @return int|null
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @module Gui
     *
     * @param int|null $start
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setStartOrFail($start)
    {
        if ($start === null) {
            $this->throwNullValueException(static::START);
        }

        return $this->setStart($start);
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getStartOrFail()
    {
        if ($this->start === null) {
            $this->throwNullValueException(static::START);
        }

        return $this->start;
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireStart()
    {
        $this->assertPropertyIsSet(self::START);

        return $this;
    }

    /**
     * @module Gui
     *
     * @param int|null $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;
        $this->modifiedProperties[self::LENGTH] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @return int|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @module Gui
     *
     * @param int|null $length
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLengthOrFail($length)
    {
        if ($length === null) {
            $this->throwNullValueException(static::LENGTH);
        }

        return $this->setLength($length);
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getLengthOrFail()
    {
        if ($this->length === null) {
            $this->throwNullValueException(static::LENGTH);
        }

        return $this->length;
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLength()
    {
        $this->assertPropertyIsSet(self::LENGTH);

        return $this;
    }

    /**
     * @module Gui
     *
     * @param array|null $search
     *
     * @return $this
     */
    public function setSearch(array $search = null)
    {
        if ($search === null) {
            $search = [];
        }

        $this->search = $search;
        $this->modifiedProperties[self::SEARCH] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @return array
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @module Gui
     *
     * @param mixed $search
     *
     * @return $this
     */
    public function addSearch($search)
    {
        $this->search[] = $search;
        $this->modifiedProperties[self::SEARCH] = true;

        return $this;
    }

    /**
     * @module Gui
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSearch()
    {
        $this->assertPropertyIsSet(self::SEARCH);

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
                case 'draw':
                case 'start':
                case 'length':
                case 'search':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'columns':
                case 'order':
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
                case 'draw':
                case 'start':
                case 'length':
                case 'search':
                    $values[$arrayKey] = $value;

                    break;
                case 'columns':
                case 'order':
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
                case 'draw':
                case 'start':
                case 'length':
                case 'search':
                    $values[$arrayKey] = $value;

                    break;
                case 'columns':
                case 'order':
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
        $this->columns = $this->columns ?: new ArrayObject();
        $this->order = $this->order ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'draw' => $this->draw,
            'start' => $this->start,
            'length' => $this->length,
            'search' => $this->search,
            'columns' => $this->columns,
            'order' => $this->order,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'draw' => $this->draw,
            'start' => $this->start,
            'length' => $this->length,
            'search' => $this->search,
            'columns' => $this->columns,
            'order' => $this->order,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'draw' => $this->draw instanceof AbstractTransfer ? $this->draw->toArray(true, false) : $this->draw,
            'start' => $this->start instanceof AbstractTransfer ? $this->start->toArray(true, false) : $this->start,
            'length' => $this->length instanceof AbstractTransfer ? $this->length->toArray(true, false) : $this->length,
            'search' => $this->search instanceof AbstractTransfer ? $this->search->toArray(true, false) : $this->search,
            'columns' => $this->columns instanceof AbstractTransfer ? $this->columns->toArray(true, false) : $this->addValuesToCollection($this->columns, true, false),
            'order' => $this->order instanceof AbstractTransfer ? $this->order->toArray(true, false) : $this->addValuesToCollection($this->order, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'draw' => $this->draw instanceof AbstractTransfer ? $this->draw->toArray(true, true) : $this->draw,
            'start' => $this->start instanceof AbstractTransfer ? $this->start->toArray(true, true) : $this->start,
            'length' => $this->length instanceof AbstractTransfer ? $this->length->toArray(true, true) : $this->length,
            'search' => $this->search instanceof AbstractTransfer ? $this->search->toArray(true, true) : $this->search,
            'columns' => $this->columns instanceof AbstractTransfer ? $this->columns->toArray(true, true) : $this->addValuesToCollection($this->columns, true, true),
            'order' => $this->order instanceof AbstractTransfer ? $this->order->toArray(true, true) : $this->addValuesToCollection($this->order, true, true),
        ];
    }
}
