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
class SearchConfigExtensionTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const FACET_CONFIGS = 'facetConfigs';

    /**
     * @var string
     */
    public const SORT_CONFIGS = 'sortConfigs';

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\FacetConfigTransfer[]
     */
    protected $facetConfigs;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SortConfigTransfer[]
     */
    protected $sortConfigs;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'facet_configs' => 'facetConfigs',
        'facetConfigs' => 'facetConfigs',
        'FacetConfigs' => 'facetConfigs',
        'sort_configs' => 'sortConfigs',
        'sortConfigs' => 'sortConfigs',
        'SortConfigs' => 'sortConfigs',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::FACET_CONFIGS => [
            'type' => 'Generated\Shared\Transfer\FacetConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'facet_configs',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SORT_CONFIGS => [
            'type' => 'Generated\Shared\Transfer\SortConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'sort_configs',
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
     * @module SearchElasticsearch|Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\FacetConfigTransfer[] $facetConfigs
     *
     * @return $this
     */
    public function setFacetConfigs(ArrayObject $facetConfigs)
    {
        $this->facetConfigs = $facetConfigs;
        $this->modifiedProperties[self::FACET_CONFIGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FacetConfigTransfer[]
     */
    public function getFacetConfigs()
    {
        return $this->facetConfigs;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\FacetConfigTransfer $facetConfig
     *
     * @return $this
     */
    public function addFacetConfig(FacetConfigTransfer $facetConfig)
    {
        $this->facetConfigs[] = $facetConfig;
        $this->modifiedProperties[self::FACET_CONFIGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFacetConfigs()
    {
        $this->assertCollectionPropertyIsSet(self::FACET_CONFIGS);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SortConfigTransfer[] $sortConfigs
     *
     * @return $this
     */
    public function setSortConfigs(ArrayObject $sortConfigs)
    {
        $this->sortConfigs = $sortConfigs;
        $this->modifiedProperties[self::SORT_CONFIGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SortConfigTransfer[]
     */
    public function getSortConfigs()
    {
        return $this->sortConfigs;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\SortConfigTransfer $sortConfig
     *
     * @return $this
     */
    public function addSortConfig(SortConfigTransfer $sortConfig)
    {
        $this->sortConfigs[] = $sortConfig;
        $this->modifiedProperties[self::SORT_CONFIGS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSortConfigs()
    {
        $this->assertCollectionPropertyIsSet(self::SORT_CONFIGS);

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
                case 'facetConfigs':
                case 'sortConfigs':
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
                case 'facetConfigs':
                case 'sortConfigs':
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
                case 'facetConfigs':
                case 'sortConfigs':
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
        $this->facetConfigs = $this->facetConfigs ?: new ArrayObject();
        $this->sortConfigs = $this->sortConfigs ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'facetConfigs' => $this->facetConfigs,
            'sortConfigs' => $this->sortConfigs,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'facet_configs' => $this->facetConfigs,
            'sort_configs' => $this->sortConfigs,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'facet_configs' => $this->facetConfigs instanceof AbstractTransfer ? $this->facetConfigs->toArray(true, false) : $this->addValuesToCollection($this->facetConfigs, true, false),
            'sort_configs' => $this->sortConfigs instanceof AbstractTransfer ? $this->sortConfigs->toArray(true, false) : $this->addValuesToCollection($this->sortConfigs, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'facetConfigs' => $this->facetConfigs instanceof AbstractTransfer ? $this->facetConfigs->toArray(true, true) : $this->addValuesToCollection($this->facetConfigs, true, true),
            'sortConfigs' => $this->sortConfigs instanceof AbstractTransfer ? $this->sortConfigs->toArray(true, true) : $this->addValuesToCollection($this->sortConfigs, true, true),
        ];
    }
}
