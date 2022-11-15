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
class CategoryMapTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const DIRECT_PARENTS = 'directParents';

    /**
     * @var string
     */
    public const ALL_PARENTS = 'allParents';

    /**
     * @var array
     */
    protected $directParents = [];

    /**
     * @var array
     */
    protected $allParents = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'direct_parents' => 'directParents',
        'directParents' => 'directParents',
        'DirectParents' => 'directParents',
        'all_parents' => 'allParents',
        'allParents' => 'allParents',
        'AllParents' => 'allParents',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::DIRECT_PARENTS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'direct_parents',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ALL_PARENTS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'all_parents',
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
     * @module Search
     *
     * @param array|null $directParents
     *
     * @return $this
     */
    public function setDirectParents(array $directParents = null)
    {
        if ($directParents === null) {
            $directParents = [];
        }

        $this->directParents = $directParents;
        $this->modifiedProperties[self::DIRECT_PARENTS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return array
     */
    public function getDirectParents()
    {
        return $this->directParents;
    }

    /**
     * @module Search
     *
     * @param mixed $directParents
     *
     * @return $this
     */
    public function addDirectParents($directParents)
    {
        $this->directParents[] = $directParents;
        $this->modifiedProperties[self::DIRECT_PARENTS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDirectParents()
    {
        $this->assertPropertyIsSet(self::DIRECT_PARENTS);

        return $this;
    }

    /**
     * @module Search
     *
     * @param array|null $allParents
     *
     * @return $this
     */
    public function setAllParents(array $allParents = null)
    {
        if ($allParents === null) {
            $allParents = [];
        }

        $this->allParents = $allParents;
        $this->modifiedProperties[self::ALL_PARENTS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return array
     */
    public function getAllParents()
    {
        return $this->allParents;
    }

    /**
     * @module Search
     *
     * @param mixed $allParents
     *
     * @return $this
     */
    public function addAllParents($allParents)
    {
        $this->allParents[] = $allParents;
        $this->modifiedProperties[self::ALL_PARENTS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireAllParents()
    {
        $this->assertPropertyIsSet(self::ALL_PARENTS);

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
                case 'directParents':
                case 'allParents':
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
                case 'directParents':
                case 'allParents':
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
                case 'directParents':
                case 'allParents':
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
            'directParents' => $this->directParents,
            'allParents' => $this->allParents,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'direct_parents' => $this->directParents,
            'all_parents' => $this->allParents,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'direct_parents' => $this->directParents instanceof AbstractTransfer ? $this->directParents->toArray(true, false) : $this->directParents,
            'all_parents' => $this->allParents instanceof AbstractTransfer ? $this->allParents->toArray(true, false) : $this->allParents,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'directParents' => $this->directParents instanceof AbstractTransfer ? $this->directParents->toArray(true, true) : $this->directParents,
            'allParents' => $this->allParents instanceof AbstractTransfer ? $this->allParents->toArray(true, true) : $this->allParents,
        ];
    }
}
