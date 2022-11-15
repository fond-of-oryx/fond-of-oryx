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
class SearchConfigurationTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const FACET_CONFIG_ITEMS = 'facetConfigItems';

    /**
     * @var string
     */
    public const SORT_CONFIG_ITEMS = 'sortConfigItems';

    /**
     * @var string
     */
    public const PAGINATION_CONFIG = 'paginationConfig';

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\FacetConfigTransfer[]
     */
    protected $facetConfigItems;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SortConfigTransfer[]
     */
    protected $sortConfigItems;

    /**
     * @var \Generated\Shared\Transfer\PaginationConfigTransfer|null
     */
    protected $paginationConfig;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'facet_config_items' => 'facetConfigItems',
        'facetConfigItems' => 'facetConfigItems',
        'FacetConfigItems' => 'facetConfigItems',
        'sort_config_items' => 'sortConfigItems',
        'sortConfigItems' => 'sortConfigItems',
        'SortConfigItems' => 'sortConfigItems',
        'pagination_config' => 'paginationConfig',
        'paginationConfig' => 'paginationConfig',
        'PaginationConfig' => 'paginationConfig',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::FACET_CONFIG_ITEMS => [
            'type' => 'Generated\Shared\Transfer\FacetConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'facet_config_items',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SORT_CONFIG_ITEMS => [
            'type' => 'Generated\Shared\Transfer\SortConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'sort_config_items',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PAGINATION_CONFIG => [
            'type' => 'Generated\Shared\Transfer\PaginationConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'pagination_config',
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
     * @module SearchElasticsearch
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\FacetConfigTransfer[] $facetConfigItems
     *
     * @return $this
     */
    public function setFacetConfigItems(ArrayObject $facetConfigItems)
    {
        $this->facetConfigItems = $facetConfigItems;
        $this->modifiedProperties[self::FACET_CONFIG_ITEMS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FacetConfigTransfer[]
     */
    public function getFacetConfigItems()
    {
        return $this->facetConfigItems;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param \Generated\Shared\Transfer\FacetConfigTransfer $facetConfigItem
     *
     * @return $this
     */
    public function addFacetConfigItem(FacetConfigTransfer $facetConfigItem)
    {
        $this->facetConfigItems[] = $facetConfigItem;
        $this->modifiedProperties[self::FACET_CONFIG_ITEMS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFacetConfigItems()
    {
        $this->assertCollectionPropertyIsSet(self::FACET_CONFIG_ITEMS);

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SortConfigTransfer[] $sortConfigItems
     *
     * @return $this
     */
    public function setSortConfigItems(ArrayObject $sortConfigItems)
    {
        $this->sortConfigItems = $sortConfigItems;
        $this->modifiedProperties[self::SORT_CONFIG_ITEMS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SortConfigTransfer[]
     */
    public function getSortConfigItems()
    {
        return $this->sortConfigItems;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param \Generated\Shared\Transfer\SortConfigTransfer $sortConfigItem
     *
     * @return $this
     */
    public function addSortConfigItem(SortConfigTransfer $sortConfigItem)
    {
        $this->sortConfigItems[] = $sortConfigItem;
        $this->modifiedProperties[self::SORT_CONFIG_ITEMS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSortConfigItems()
    {
        $this->assertCollectionPropertyIsSet(self::SORT_CONFIG_ITEMS);

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param \Generated\Shared\Transfer\PaginationConfigTransfer|null $paginationConfig
     *
     * @return $this
     */
    public function setPaginationConfig(PaginationConfigTransfer $paginationConfig = null)
    {
        $this->paginationConfig = $paginationConfig;
        $this->modifiedProperties[self::PAGINATION_CONFIG] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer|null
     */
    public function getPaginationConfig()
    {
        return $this->paginationConfig;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param \Generated\Shared\Transfer\PaginationConfigTransfer $paginationConfig
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPaginationConfigOrFail(PaginationConfigTransfer $paginationConfig)
    {
        return $this->setPaginationConfig($paginationConfig);
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer
     */
    public function getPaginationConfigOrFail()
    {
        if ($this->paginationConfig === null) {
            $this->throwNullValueException(static::PAGINATION_CONFIG);
        }

        return $this->paginationConfig;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePaginationConfig()
    {
        $this->assertPropertyIsSet(self::PAGINATION_CONFIG);

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
                case 'paginationConfig':
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
                case 'facetConfigItems':
                case 'sortConfigItems':
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
                case 'paginationConfig':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

                    break;
                case 'facetConfigItems':
                case 'sortConfigItems':
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
                case 'paginationConfig':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

                    break;
                case 'facetConfigItems':
                case 'sortConfigItems':
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
        $this->facetConfigItems = $this->facetConfigItems ?: new ArrayObject();
        $this->sortConfigItems = $this->sortConfigItems ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'paginationConfig' => $this->paginationConfig,
            'facetConfigItems' => $this->facetConfigItems,
            'sortConfigItems' => $this->sortConfigItems,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'pagination_config' => $this->paginationConfig,
            'facet_config_items' => $this->facetConfigItems,
            'sort_config_items' => $this->sortConfigItems,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'pagination_config' => $this->paginationConfig instanceof AbstractTransfer ? $this->paginationConfig->toArray(true, false) : $this->paginationConfig,
            'facet_config_items' => $this->facetConfigItems instanceof AbstractTransfer ? $this->facetConfigItems->toArray(true, false) : $this->addValuesToCollection($this->facetConfigItems, true, false),
            'sort_config_items' => $this->sortConfigItems instanceof AbstractTransfer ? $this->sortConfigItems->toArray(true, false) : $this->addValuesToCollection($this->sortConfigItems, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'paginationConfig' => $this->paginationConfig instanceof AbstractTransfer ? $this->paginationConfig->toArray(true, true) : $this->paginationConfig,
            'facetConfigItems' => $this->facetConfigItems instanceof AbstractTransfer ? $this->facetConfigItems->toArray(true, true) : $this->addValuesToCollection($this->facetConfigItems, true, true),
            'sortConfigItems' => $this->sortConfigItems instanceof AbstractTransfer ? $this->sortConfigItems->toArray(true, true) : $this->addValuesToCollection($this->sortConfigItems, true, true),
        ];
    }
}
