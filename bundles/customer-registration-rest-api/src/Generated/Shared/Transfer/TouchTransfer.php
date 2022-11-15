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
class TouchTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const ID_TOUCH = 'idTouch';

    /**
     * @var string
     */
    public const ITEM_TYPE = 'itemType';

    /**
     * @var string
     */
    public const ITEM_EVENT = 'itemEvent';

    /**
     * @var string
     */
    public const ITEM_ID = 'itemId';

    /**
     * @var string
     */
    public const TOUCHED = 'touched';

    /**
     * @var int|null
     */
    protected $idTouch;

    /**
     * @var int|null
     */
    protected $itemType;

    /**
     * @var int|null
     */
    protected $itemEvent;

    /**
     * @var int|null
     */
    protected $itemId;

    /**
     * @var string|null
     */
    protected $touched;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'id_touch' => 'idTouch',
        'idTouch' => 'idTouch',
        'IdTouch' => 'idTouch',
        'item_type' => 'itemType',
        'itemType' => 'itemType',
        'ItemType' => 'itemType',
        'item_event' => 'itemEvent',
        'itemEvent' => 'itemEvent',
        'ItemEvent' => 'itemEvent',
        'item_id' => 'itemId',
        'itemId' => 'itemId',
        'ItemId' => 'itemId',
        'touched' => 'touched',
        'Touched' => 'touched',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::ID_TOUCH => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'id_touch',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ITEM_TYPE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'item_type',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ITEM_EVENT => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'item_event',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ITEM_ID => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'item_id',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::TOUCHED => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'touched',
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
     * @module Touch
     *
     * @param int|null $idTouch
     *
     * @return $this
     */
    public function setIdTouch($idTouch)
    {
        $this->idTouch = $idTouch;
        $this->modifiedProperties[self::ID_TOUCH] = true;

        return $this;
    }

    /**
     * @module Touch
     *
     * @return int|null
     */
    public function getIdTouch()
    {
        return $this->idTouch;
    }

    /**
     * @module Touch
     *
     * @param int|null $idTouch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIdTouchOrFail($idTouch)
    {
        if ($idTouch === null) {
            $this->throwNullValueException(static::ID_TOUCH);
        }

        return $this->setIdTouch($idTouch);
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getIdTouchOrFail()
    {
        if ($this->idTouch === null) {
            $this->throwNullValueException(static::ID_TOUCH);
        }

        return $this->idTouch;
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIdTouch()
    {
        $this->assertPropertyIsSet(self::ID_TOUCH);

        return $this;
    }

    /**
     * @module Touch
     *
     * @param int|null $itemType
     *
     * @return $this
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
        $this->modifiedProperties[self::ITEM_TYPE] = true;

        return $this;
    }

    /**
     * @module Touch
     *
     * @return int|null
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @module Touch
     *
     * @param int|null $itemType
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setItemTypeOrFail($itemType)
    {
        if ($itemType === null) {
            $this->throwNullValueException(static::ITEM_TYPE);
        }

        return $this->setItemType($itemType);
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getItemTypeOrFail()
    {
        if ($this->itemType === null) {
            $this->throwNullValueException(static::ITEM_TYPE);
        }

        return $this->itemType;
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireItemType()
    {
        $this->assertPropertyIsSet(self::ITEM_TYPE);

        return $this;
    }

    /**
     * @module Touch
     *
     * @param int|null $itemEvent
     *
     * @return $this
     */
    public function setItemEvent($itemEvent)
    {
        $this->itemEvent = $itemEvent;
        $this->modifiedProperties[self::ITEM_EVENT] = true;

        return $this;
    }

    /**
     * @module Touch
     *
     * @return int|null
     */
    public function getItemEvent()
    {
        return $this->itemEvent;
    }

    /**
     * @module Touch
     *
     * @param int|null $itemEvent
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setItemEventOrFail($itemEvent)
    {
        if ($itemEvent === null) {
            $this->throwNullValueException(static::ITEM_EVENT);
        }

        return $this->setItemEvent($itemEvent);
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getItemEventOrFail()
    {
        if ($this->itemEvent === null) {
            $this->throwNullValueException(static::ITEM_EVENT);
        }

        return $this->itemEvent;
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireItemEvent()
    {
        $this->assertPropertyIsSet(self::ITEM_EVENT);

        return $this;
    }

    /**
     * @module Touch
     *
     * @param int|null $itemId
     *
     * @return $this
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
        $this->modifiedProperties[self::ITEM_ID] = true;

        return $this;
    }

    /**
     * @module Touch
     *
     * @return int|null
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @module Touch
     *
     * @param int|null $itemId
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setItemIdOrFail($itemId)
    {
        if ($itemId === null) {
            $this->throwNullValueException(static::ITEM_ID);
        }

        return $this->setItemId($itemId);
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getItemIdOrFail()
    {
        if ($this->itemId === null) {
            $this->throwNullValueException(static::ITEM_ID);
        }

        return $this->itemId;
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireItemId()
    {
        $this->assertPropertyIsSet(self::ITEM_ID);

        return $this;
    }

    /**
     * @module Touch
     *
     * @param string|null $touched
     *
     * @return $this
     */
    public function setTouched($touched)
    {
        $this->touched = $touched;
        $this->modifiedProperties[self::TOUCHED] = true;

        return $this;
    }

    /**
     * @module Touch
     *
     * @return string|null
     */
    public function getTouched()
    {
        return $this->touched;
    }

    /**
     * @module Touch
     *
     * @param string|null $touched
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setTouchedOrFail($touched)
    {
        if ($touched === null) {
            $this->throwNullValueException(static::TOUCHED);
        }

        return $this->setTouched($touched);
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getTouchedOrFail()
    {
        if ($this->touched === null) {
            $this->throwNullValueException(static::TOUCHED);
        }

        return $this->touched;
    }

    /**
     * @module Touch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireTouched()
    {
        $this->assertPropertyIsSet(self::TOUCHED);

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
                case 'idTouch':
                case 'itemType':
                case 'itemEvent':
                case 'itemId':
                case 'touched':
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
                case 'idTouch':
                case 'itemType':
                case 'itemEvent':
                case 'itemId':
                case 'touched':
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
                case 'idTouch':
                case 'itemType':
                case 'itemEvent':
                case 'itemId':
                case 'touched':
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
            'idTouch' => $this->idTouch,
            'itemType' => $this->itemType,
            'itemEvent' => $this->itemEvent,
            'itemId' => $this->itemId,
            'touched' => $this->touched,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'id_touch' => $this->idTouch,
            'item_type' => $this->itemType,
            'item_event' => $this->itemEvent,
            'item_id' => $this->itemId,
            'touched' => $this->touched,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'id_touch' => $this->idTouch instanceof AbstractTransfer ? $this->idTouch->toArray(true, false) : $this->idTouch,
            'item_type' => $this->itemType instanceof AbstractTransfer ? $this->itemType->toArray(true, false) : $this->itemType,
            'item_event' => $this->itemEvent instanceof AbstractTransfer ? $this->itemEvent->toArray(true, false) : $this->itemEvent,
            'item_id' => $this->itemId instanceof AbstractTransfer ? $this->itemId->toArray(true, false) : $this->itemId,
            'touched' => $this->touched instanceof AbstractTransfer ? $this->touched->toArray(true, false) : $this->touched,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'idTouch' => $this->idTouch instanceof AbstractTransfer ? $this->idTouch->toArray(true, true) : $this->idTouch,
            'itemType' => $this->itemType instanceof AbstractTransfer ? $this->itemType->toArray(true, true) : $this->itemType,
            'itemEvent' => $this->itemEvent instanceof AbstractTransfer ? $this->itemEvent->toArray(true, true) : $this->itemEvent,
            'itemId' => $this->itemId instanceof AbstractTransfer ? $this->itemId->toArray(true, true) : $this->itemId,
            'touched' => $this->touched instanceof AbstractTransfer ? $this->touched->toArray(true, true) : $this->touched,
        ];
    }
}
