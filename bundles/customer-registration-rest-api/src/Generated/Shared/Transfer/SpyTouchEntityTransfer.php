<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use ArrayObject;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractEntityTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class SpyTouchEntityTransfer extends AbstractEntityTransfer
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
     * @var string
     */
    public const SPY_TOUCH_STORAGES = 'spyTouchStorages';

    /**
     * @var string
     */
    public const SPY_TOUCH_SEARCHES = 'spyTouchSearches';

    /**
     * @var integer|null
     */
    protected $idTouch;

    /**
     * @var string|null
     */
    protected $itemType;

    /**
     * @var string|null
     */
    protected $itemEvent;

    /**
     * @var integer|null
     */
    protected $itemId;

    /**
     * @var string|null
     */
    protected $touched;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SpyTouchStorageEntityTransfer[]
     */
    protected $spyTouchStorages;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SpyTouchSearchEntityTransfer[]
     */
    protected $spyTouchSearches;

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
        'spy_touch_storages' => 'spyTouchStorages',
        'spyTouchStorages' => 'spyTouchStorages',
        'SpyTouchStorages' => 'spyTouchStorages',
        'spy_touch_searches' => 'spyTouchSearches',
        'spyTouchSearches' => 'spyTouchSearches',
        'SpyTouchSearches' => 'spyTouchSearches',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::ID_TOUCH => [
            'type' => 'integer',
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
            'type' => 'string',
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
            'type' => 'string',
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
            'type' => 'integer',
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
        self::SPY_TOUCH_STORAGES => [
            'type' => 'Generated\Shared\Transfer\SpyTouchStorageEntityTransfer',
            'type_shim' => null,
            'name_underscore' => 'spy_touch_storages',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SPY_TOUCH_SEARCHES => [
            'type' => 'Generated\Shared\Transfer\SpyTouchSearchEntityTransfer',
            'type_shim' => null,
            'name_underscore' => 'spy_touch_searches',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];
    /**
     * @var string
     */
    public static $entityNamespace = 'Orm\Zed\Touch\Persistence\SpyTouch';


    /**
     * @module 
     *
     * @param integer|null $idTouch
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
     * @module 
     *
     * @return integer|null
     */
    public function getIdTouch()
    {
        return $this->idTouch;
    }

    /**
     * @module 
     *
     * @param integer|null $idTouch
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
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return integer
     */
    public function getIdTouchOrFail()
    {
        if ($this->idTouch === null) {
            $this->throwNullValueException(static::ID_TOUCH);
        }

        return $this->idTouch;
    }

    /**
     * @module 
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
     * @module 
     *
     * @param string|null $itemType
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
     * @module 
     *
     * @return string|null
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @module 
     *
     * @param string|null $itemType
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
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getItemTypeOrFail()
    {
        if ($this->itemType === null) {
            $this->throwNullValueException(static::ITEM_TYPE);
        }

        return $this->itemType;
    }

    /**
     * @module 
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
     * @module 
     *
     * @param string|null $itemEvent
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
     * @module 
     *
     * @return string|null
     */
    public function getItemEvent()
    {
        return $this->itemEvent;
    }

    /**
     * @module 
     *
     * @param string|null $itemEvent
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
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getItemEventOrFail()
    {
        if ($this->itemEvent === null) {
            $this->throwNullValueException(static::ITEM_EVENT);
        }

        return $this->itemEvent;
    }

    /**
     * @module 
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
     * @module 
     *
     * @param integer|null $itemId
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
     * @module 
     *
     * @return integer|null
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @module 
     *
     * @param integer|null $itemId
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
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return integer
     */
    public function getItemIdOrFail()
    {
        if ($this->itemId === null) {
            $this->throwNullValueException(static::ITEM_ID);
        }

        return $this->itemId;
    }

    /**
     * @module 
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
     * @module 
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
     * @module 
     *
     * @return string|null
     */
    public function getTouched()
    {
        return $this->touched;
    }

    /**
     * @module 
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
     * @module 
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
     * @module 
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
     * @module 
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SpyTouchStorageEntityTransfer[] $spyTouchStorages
     *
     * @return $this
     */
    public function setSpyTouchStorages(ArrayObject $spyTouchStorages)
    {
        $this->spyTouchStorages = $spyTouchStorages;
        $this->modifiedProperties[self::SPY_TOUCH_STORAGES] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SpyTouchStorageEntityTransfer[]
     */
    public function getSpyTouchStorages()
    {
        return $this->spyTouchStorages;
    }

    /**
     * @module 
     *
     * @param \Generated\Shared\Transfer\SpyTouchStorageEntityTransfer $spyTouchStorages
     *
     * @return $this
     */
    public function addSpyTouchStorages(SpyTouchStorageEntityTransfer $spyTouchStorages)
    {
        $this->spyTouchStorages[] = $spyTouchStorages;
        $this->modifiedProperties[self::SPY_TOUCH_STORAGES] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSpyTouchStorages()
    {
        $this->assertCollectionPropertyIsSet(self::SPY_TOUCH_STORAGES);

        return $this;
    }

    /**
     * @module 
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SpyTouchSearchEntityTransfer[] $spyTouchSearches
     *
     * @return $this
     */
    public function setSpyTouchSearches(ArrayObject $spyTouchSearches)
    {
        $this->spyTouchSearches = $spyTouchSearches;
        $this->modifiedProperties[self::SPY_TOUCH_SEARCHES] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SpyTouchSearchEntityTransfer[]
     */
    public function getSpyTouchSearches()
    {
        return $this->spyTouchSearches;
    }

    /**
     * @module 
     *
     * @param \Generated\Shared\Transfer\SpyTouchSearchEntityTransfer $spyTouchSearches
     *
     * @return $this
     */
    public function addSpyTouchSearches(SpyTouchSearchEntityTransfer $spyTouchSearches)
    {
        $this->spyTouchSearches[] = $spyTouchSearches;
        $this->modifiedProperties[self::SPY_TOUCH_SEARCHES] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSpyTouchSearches()
    {
        $this->assertCollectionPropertyIsSet(self::SPY_TOUCH_SEARCHES);

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
                case 'spyTouchStorages':
                case 'spyTouchSearches':
                    $elementType = $this->transferMetadata[$normalizedPropertyName]['type'];
                    $this->$normalizedPropertyName = $this->processArrayObject($elementType, $value, $ignoreMissingProperty);
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                default:
                    if (!$ignoreMissingProperty) {
                        throw new \InvalidArgumentException(sprintf('Missing property `%s` in `%s`', $property, static::class));
                    }
                    $this->virtualProperties[$property] = $value;
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
                case 'spyTouchStorages':
                case 'spyTouchSearches':
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
                case 'idTouch':
                case 'itemType':
                case 'itemEvent':
                case 'itemId':
                case 'touched':
                    $values[$arrayKey] = $value;

                    break;
                case 'spyTouchStorages':
                case 'spyTouchSearches':
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
        $this->spyTouchStorages = $this->spyTouchStorages ?: new ArrayObject();
        $this->spyTouchSearches = $this->spyTouchSearches ?: new ArrayObject();
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
            'spyTouchStorages' => $this->spyTouchStorages,
            'spyTouchSearches' => $this->spyTouchSearches,
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
            'spy_touch_storages' => $this->spyTouchStorages,
            'spy_touch_searches' => $this->spyTouchSearches,
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
            'spy_touch_storages' => $this->spyTouchStorages instanceof AbstractTransfer ? $this->spyTouchStorages->toArray(true, false) : $this->addValuesToCollection($this->spyTouchStorages, true, false),
            'spy_touch_searches' => $this->spyTouchSearches instanceof AbstractTransfer ? $this->spyTouchSearches->toArray(true, false) : $this->addValuesToCollection($this->spyTouchSearches, true, false),
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
            'spyTouchStorages' => $this->spyTouchStorages instanceof AbstractTransfer ? $this->spyTouchStorages->toArray(true, true) : $this->addValuesToCollection($this->spyTouchStorages, true, true),
            'spyTouchSearches' => $this->spyTouchSearches instanceof AbstractTransfer ? $this->spyTouchSearches->toArray(true, true) : $this->addValuesToCollection($this->spyTouchSearches, true, true),
        ];
    }
}
