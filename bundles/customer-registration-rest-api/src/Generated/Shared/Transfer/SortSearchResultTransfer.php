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
class SortSearchResultTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const SORT_PARAM_NAMES = 'sortParamNames';

    /**
     * @var string
     */
    public const CURRENT_SORT_PARAM = 'currentSortParam';

    /**
     * @var string
     */
    public const CURRENT_SORT_ORDER = 'currentSortOrder';

    /**
     * @var array
     */
    protected $sortParamNames = [];

    /**
     * @var string|null
     */
    protected $currentSortParam;

    /**
     * @var string|null
     */
    protected $currentSortOrder;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'sort_param_names' => 'sortParamNames',
        'sortParamNames' => 'sortParamNames',
        'SortParamNames' => 'sortParamNames',
        'current_sort_param' => 'currentSortParam',
        'currentSortParam' => 'currentSortParam',
        'CurrentSortParam' => 'currentSortParam',
        'current_sort_order' => 'currentSortOrder',
        'currentSortOrder' => 'currentSortOrder',
        'CurrentSortOrder' => 'currentSortOrder',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::SORT_PARAM_NAMES => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'sort_param_names',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CURRENT_SORT_PARAM => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'current_sort_param',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CURRENT_SORT_ORDER => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'current_sort_order',
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
     * @module SearchElasticsearch|Search
     *
     * @param array|null $sortParamNames
     *
     * @return $this
     */
    public function setSortParamNames(array $sortParamNames = null)
    {
        if ($sortParamNames === null) {
            $sortParamNames = [];
        }

        $this->sortParamNames = $sortParamNames;
        $this->modifiedProperties[self::SORT_PARAM_NAMES] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return array
     */
    public function getSortParamNames()
    {
        return $this->sortParamNames;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param mixed $sortParamNames
     *
     * @return $this
     */
    public function addSortParamNames($sortParamNames)
    {
        $this->sortParamNames[] = $sortParamNames;
        $this->modifiedProperties[self::SORT_PARAM_NAMES] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSortParamNames()
    {
        $this->assertPropertyIsSet(self::SORT_PARAM_NAMES);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $currentSortParam
     *
     * @return $this
     */
    public function setCurrentSortParam($currentSortParam)
    {
        $this->currentSortParam = $currentSortParam;
        $this->modifiedProperties[self::CURRENT_SORT_PARAM] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return string|null
     */
    public function getCurrentSortParam()
    {
        return $this->currentSortParam;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $currentSortParam
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCurrentSortParamOrFail($currentSortParam)
    {
        if ($currentSortParam === null) {
            $this->throwNullValueException(static::CURRENT_SORT_PARAM);
        }

        return $this->setCurrentSortParam($currentSortParam);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getCurrentSortParamOrFail()
    {
        if ($this->currentSortParam === null) {
            $this->throwNullValueException(static::CURRENT_SORT_PARAM);
        }

        return $this->currentSortParam;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCurrentSortParam()
    {
        $this->assertPropertyIsSet(self::CURRENT_SORT_PARAM);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $currentSortOrder
     *
     * @return $this
     */
    public function setCurrentSortOrder($currentSortOrder)
    {
        $this->currentSortOrder = $currentSortOrder;
        $this->modifiedProperties[self::CURRENT_SORT_ORDER] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return string|null
     */
    public function getCurrentSortOrder()
    {
        return $this->currentSortOrder;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $currentSortOrder
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCurrentSortOrderOrFail($currentSortOrder)
    {
        if ($currentSortOrder === null) {
            $this->throwNullValueException(static::CURRENT_SORT_ORDER);
        }

        return $this->setCurrentSortOrder($currentSortOrder);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getCurrentSortOrderOrFail()
    {
        if ($this->currentSortOrder === null) {
            $this->throwNullValueException(static::CURRENT_SORT_ORDER);
        }

        return $this->currentSortOrder;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCurrentSortOrder()
    {
        $this->assertPropertyIsSet(self::CURRENT_SORT_ORDER);

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
                case 'sortParamNames':
                case 'currentSortParam':
                case 'currentSortOrder':
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
                case 'sortParamNames':
                case 'currentSortParam':
                case 'currentSortOrder':
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
                case 'sortParamNames':
                case 'currentSortParam':
                case 'currentSortOrder':
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
            'sortParamNames' => $this->sortParamNames,
            'currentSortParam' => $this->currentSortParam,
            'currentSortOrder' => $this->currentSortOrder,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'sort_param_names' => $this->sortParamNames,
            'current_sort_param' => $this->currentSortParam,
            'current_sort_order' => $this->currentSortOrder,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'sort_param_names' => $this->sortParamNames instanceof AbstractTransfer ? $this->sortParamNames->toArray(true, false) : $this->sortParamNames,
            'current_sort_param' => $this->currentSortParam instanceof AbstractTransfer ? $this->currentSortParam->toArray(true, false) : $this->currentSortParam,
            'current_sort_order' => $this->currentSortOrder instanceof AbstractTransfer ? $this->currentSortOrder->toArray(true, false) : $this->currentSortOrder,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'sortParamNames' => $this->sortParamNames instanceof AbstractTransfer ? $this->sortParamNames->toArray(true, true) : $this->sortParamNames,
            'currentSortParam' => $this->currentSortParam instanceof AbstractTransfer ? $this->currentSortParam->toArray(true, true) : $this->currentSortParam,
            'currentSortOrder' => $this->currentSortOrder instanceof AbstractTransfer ? $this->currentSortOrder->toArray(true, true) : $this->currentSortOrder,
        ];
    }
}
