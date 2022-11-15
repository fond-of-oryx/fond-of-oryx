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
class NumberFormatConfigTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const GROUPING_SEPARATOR_SYMBOL = 'groupingSeparatorSymbol';

    /**
     * @var string
     */
    public const DECIMAL_SEPARATOR_SYMBOL = 'decimalSeparatorSymbol';

    /**
     * @var string|null
     */
    protected $groupingSeparatorSymbol;

    /**
     * @var string|null
     */
    protected $decimalSeparatorSymbol;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'grouping_separator_symbol' => 'groupingSeparatorSymbol',
        'groupingSeparatorSymbol' => 'groupingSeparatorSymbol',
        'GroupingSeparatorSymbol' => 'groupingSeparatorSymbol',
        'decimal_separator_symbol' => 'decimalSeparatorSymbol',
        'decimalSeparatorSymbol' => 'decimalSeparatorSymbol',
        'DecimalSeparatorSymbol' => 'decimalSeparatorSymbol',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::GROUPING_SEPARATOR_SYMBOL => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'grouping_separator_symbol',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::DECIMAL_SEPARATOR_SYMBOL => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'decimal_separator_symbol',
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
     * @module Gui|UtilNumber
     *
     * @param string|null $groupingSeparatorSymbol
     *
     * @return $this
     */
    public function setGroupingSeparatorSymbol($groupingSeparatorSymbol)
    {
        $this->groupingSeparatorSymbol = $groupingSeparatorSymbol;
        $this->modifiedProperties[self::GROUPING_SEPARATOR_SYMBOL] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return string|null
     */
    public function getGroupingSeparatorSymbol()
    {
        return $this->groupingSeparatorSymbol;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param string|null $groupingSeparatorSymbol
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setGroupingSeparatorSymbolOrFail($groupingSeparatorSymbol)
    {
        if ($groupingSeparatorSymbol === null) {
            $this->throwNullValueException(static::GROUPING_SEPARATOR_SYMBOL);
        }

        return $this->setGroupingSeparatorSymbol($groupingSeparatorSymbol);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getGroupingSeparatorSymbolOrFail()
    {
        if ($this->groupingSeparatorSymbol === null) {
            $this->throwNullValueException(static::GROUPING_SEPARATOR_SYMBOL);
        }

        return $this->groupingSeparatorSymbol;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireGroupingSeparatorSymbol()
    {
        $this->assertPropertyIsSet(self::GROUPING_SEPARATOR_SYMBOL);

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param string|null $decimalSeparatorSymbol
     *
     * @return $this
     */
    public function setDecimalSeparatorSymbol($decimalSeparatorSymbol)
    {
        $this->decimalSeparatorSymbol = $decimalSeparatorSymbol;
        $this->modifiedProperties[self::DECIMAL_SEPARATOR_SYMBOL] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return string|null
     */
    public function getDecimalSeparatorSymbol()
    {
        return $this->decimalSeparatorSymbol;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param string|null $decimalSeparatorSymbol
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDecimalSeparatorSymbolOrFail($decimalSeparatorSymbol)
    {
        if ($decimalSeparatorSymbol === null) {
            $this->throwNullValueException(static::DECIMAL_SEPARATOR_SYMBOL);
        }

        return $this->setDecimalSeparatorSymbol($decimalSeparatorSymbol);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getDecimalSeparatorSymbolOrFail()
    {
        if ($this->decimalSeparatorSymbol === null) {
            $this->throwNullValueException(static::DECIMAL_SEPARATOR_SYMBOL);
        }

        return $this->decimalSeparatorSymbol;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDecimalSeparatorSymbol()
    {
        $this->assertPropertyIsSet(self::DECIMAL_SEPARATOR_SYMBOL);

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
                case 'groupingSeparatorSymbol':
                case 'decimalSeparatorSymbol':
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
                case 'groupingSeparatorSymbol':
                case 'decimalSeparatorSymbol':
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
                case 'groupingSeparatorSymbol':
                case 'decimalSeparatorSymbol':
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
            'groupingSeparatorSymbol' => $this->groupingSeparatorSymbol,
            'decimalSeparatorSymbol' => $this->decimalSeparatorSymbol,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'grouping_separator_symbol' => $this->groupingSeparatorSymbol,
            'decimal_separator_symbol' => $this->decimalSeparatorSymbol,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'grouping_separator_symbol' => $this->groupingSeparatorSymbol instanceof AbstractTransfer ? $this->groupingSeparatorSymbol->toArray(true, false) : $this->groupingSeparatorSymbol,
            'decimal_separator_symbol' => $this->decimalSeparatorSymbol instanceof AbstractTransfer ? $this->decimalSeparatorSymbol->toArray(true, false) : $this->decimalSeparatorSymbol,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'groupingSeparatorSymbol' => $this->groupingSeparatorSymbol instanceof AbstractTransfer ? $this->groupingSeparatorSymbol->toArray(true, true) : $this->groupingSeparatorSymbol,
            'decimalSeparatorSymbol' => $this->decimalSeparatorSymbol instanceof AbstractTransfer ? $this->decimalSeparatorSymbol->toArray(true, true) : $this->decimalSeparatorSymbol,
        ];
    }
}
