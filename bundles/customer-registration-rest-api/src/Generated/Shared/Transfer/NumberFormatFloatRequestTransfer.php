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
class NumberFormatFloatRequestTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const NUMBER = 'number';

    /**
     * @var string
     */
    public const NUMBER_FORMAT_FILTER = 'numberFormatFilter';

    /**
     * @var float|null
     */
    protected $number;

    /**
     * @var \Generated\Shared\Transfer\NumberFormatFilterTransfer|null
     */
    protected $numberFormatFilter;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'number' => 'number',
        'Number' => 'number',
        'number_format_filter' => 'numberFormatFilter',
        'numberFormatFilter' => 'numberFormatFilter',
        'NumberFormatFilter' => 'numberFormatFilter',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::NUMBER => [
            'type' => 'float',
            'type_shim' => null,
            'name_underscore' => 'number',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::NUMBER_FORMAT_FILTER => [
            'type' => 'Generated\Shared\Transfer\NumberFormatFilterTransfer',
            'type_shim' => null,
            'name_underscore' => 'number_format_filter',
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
     * @module Gui|UtilNumber
     *
     * @param float|null $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        $this->modifiedProperties[self::NUMBER] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return float|null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param float|null $number
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setNumberOrFail($number)
    {
        if ($number === null) {
            $this->throwNullValueException(static::NUMBER);
        }

        return $this->setNumber($number);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return float
     */
    public function getNumberOrFail()
    {
        if ($this->number === null) {
            $this->throwNullValueException(static::NUMBER);
        }

        return $this->number;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireNumber()
    {
        $this->assertPropertyIsSet(self::NUMBER);

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param \Generated\Shared\Transfer\NumberFormatFilterTransfer|null $numberFormatFilter
     *
     * @return $this
     */
    public function setNumberFormatFilter(NumberFormatFilterTransfer $numberFormatFilter = null)
    {
        $this->numberFormatFilter = $numberFormatFilter;
        $this->modifiedProperties[self::NUMBER_FORMAT_FILTER] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return \Generated\Shared\Transfer\NumberFormatFilterTransfer|null
     */
    public function getNumberFormatFilter()
    {
        return $this->numberFormatFilter;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param \Generated\Shared\Transfer\NumberFormatFilterTransfer $numberFormatFilter
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setNumberFormatFilterOrFail(NumberFormatFilterTransfer $numberFormatFilter)
    {
        return $this->setNumberFormatFilter($numberFormatFilter);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\NumberFormatFilterTransfer
     */
    public function getNumberFormatFilterOrFail()
    {
        if ($this->numberFormatFilter === null) {
            $this->throwNullValueException(static::NUMBER_FORMAT_FILTER);
        }

        return $this->numberFormatFilter;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireNumberFormatFilter()
    {
        $this->assertPropertyIsSet(self::NUMBER_FORMAT_FILTER);

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
                case 'number':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'numberFormatFilter':
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
                case 'number':
                    $values[$arrayKey] = $value;

                    break;
                case 'numberFormatFilter':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

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
                case 'number':
                    $values[$arrayKey] = $value;

                    break;
                case 'numberFormatFilter':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

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
            'number' => $this->number,
            'numberFormatFilter' => $this->numberFormatFilter,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'number' => $this->number,
            'number_format_filter' => $this->numberFormatFilter,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'number' => $this->number instanceof AbstractTransfer ? $this->number->toArray(true, false) : $this->number,
            'number_format_filter' => $this->numberFormatFilter instanceof AbstractTransfer ? $this->numberFormatFilter->toArray(true, false) : $this->numberFormatFilter,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'number' => $this->number instanceof AbstractTransfer ? $this->number->toArray(true, true) : $this->number,
            'numberFormatFilter' => $this->numberFormatFilter instanceof AbstractTransfer ? $this->numberFormatFilter->toArray(true, true) : $this->numberFormatFilter,
        ];
    }
}
