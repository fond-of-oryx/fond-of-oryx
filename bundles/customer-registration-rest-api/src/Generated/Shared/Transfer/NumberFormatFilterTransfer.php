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
class NumberFormatFilterTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const MAX_FRACTION_DIGITS = 'maxFractionDigits';

    /**
     * @var string
     */
    public const NUMBER_FORMAT_STYLE = 'numberFormatStyle';

    /**
     * @var string
     */
    public const LOCALE = 'locale';

    /**
     * @var int|null
     */
    protected $maxFractionDigits;

    /**
     * @var int|null
     */
    protected $numberFormatStyle;

    /**
     * @var string|null
     */
    protected $locale;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'max_fraction_digits' => 'maxFractionDigits',
        'maxFractionDigits' => 'maxFractionDigits',
        'MaxFractionDigits' => 'maxFractionDigits',
        'number_format_style' => 'numberFormatStyle',
        'numberFormatStyle' => 'numberFormatStyle',
        'NumberFormatStyle' => 'numberFormatStyle',
        'locale' => 'locale',
        'Locale' => 'locale',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::MAX_FRACTION_DIGITS => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'max_fraction_digits',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::NUMBER_FORMAT_STYLE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'number_format_style',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LOCALE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'locale',
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
     * @param int|null $maxFractionDigits
     *
     * @return $this
     */
    public function setMaxFractionDigits($maxFractionDigits)
    {
        $this->maxFractionDigits = $maxFractionDigits;
        $this->modifiedProperties[self::MAX_FRACTION_DIGITS] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return int|null
     */
    public function getMaxFractionDigits()
    {
        return $this->maxFractionDigits;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param int|null $maxFractionDigits
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setMaxFractionDigitsOrFail($maxFractionDigits)
    {
        if ($maxFractionDigits === null) {
            $this->throwNullValueException(static::MAX_FRACTION_DIGITS);
        }

        return $this->setMaxFractionDigits($maxFractionDigits);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getMaxFractionDigitsOrFail()
    {
        if ($this->maxFractionDigits === null) {
            $this->throwNullValueException(static::MAX_FRACTION_DIGITS);
        }

        return $this->maxFractionDigits;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireMaxFractionDigits()
    {
        $this->assertPropertyIsSet(self::MAX_FRACTION_DIGITS);

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param int|null $numberFormatStyle
     *
     * @return $this
     */
    public function setNumberFormatStyle($numberFormatStyle)
    {
        $this->numberFormatStyle = $numberFormatStyle;
        $this->modifiedProperties[self::NUMBER_FORMAT_STYLE] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return int|null
     */
    public function getNumberFormatStyle()
    {
        return $this->numberFormatStyle;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param int|null $numberFormatStyle
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setNumberFormatStyleOrFail($numberFormatStyle)
    {
        if ($numberFormatStyle === null) {
            $this->throwNullValueException(static::NUMBER_FORMAT_STYLE);
        }

        return $this->setNumberFormatStyle($numberFormatStyle);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getNumberFormatStyleOrFail()
    {
        if ($this->numberFormatStyle === null) {
            $this->throwNullValueException(static::NUMBER_FORMAT_STYLE);
        }

        return $this->numberFormatStyle;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireNumberFormatStyle()
    {
        $this->assertPropertyIsSet(self::NUMBER_FORMAT_STYLE);

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param string|null $locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->modifiedProperties[self::LOCALE] = true;

        return $this;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @return string|null
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @param string|null $locale
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLocaleOrFail($locale)
    {
        if ($locale === null) {
            $this->throwNullValueException(static::LOCALE);
        }

        return $this->setLocale($locale);
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getLocaleOrFail()
    {
        if ($this->locale === null) {
            $this->throwNullValueException(static::LOCALE);
        }

        return $this->locale;
    }

    /**
     * @module Gui|UtilNumber
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLocale()
    {
        $this->assertPropertyIsSet(self::LOCALE);

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
                case 'maxFractionDigits':
                case 'numberFormatStyle':
                case 'locale':
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
                case 'maxFractionDigits':
                case 'numberFormatStyle':
                case 'locale':
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
                case 'maxFractionDigits':
                case 'numberFormatStyle':
                case 'locale':
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
            'maxFractionDigits' => $this->maxFractionDigits,
            'numberFormatStyle' => $this->numberFormatStyle,
            'locale' => $this->locale,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'max_fraction_digits' => $this->maxFractionDigits,
            'number_format_style' => $this->numberFormatStyle,
            'locale' => $this->locale,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'max_fraction_digits' => $this->maxFractionDigits instanceof AbstractTransfer ? $this->maxFractionDigits->toArray(true, false) : $this->maxFractionDigits,
            'number_format_style' => $this->numberFormatStyle instanceof AbstractTransfer ? $this->numberFormatStyle->toArray(true, false) : $this->numberFormatStyle,
            'locale' => $this->locale instanceof AbstractTransfer ? $this->locale->toArray(true, false) : $this->locale,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'maxFractionDigits' => $this->maxFractionDigits instanceof AbstractTransfer ? $this->maxFractionDigits->toArray(true, true) : $this->maxFractionDigits,
            'numberFormatStyle' => $this->numberFormatStyle instanceof AbstractTransfer ? $this->numberFormatStyle->toArray(true, true) : $this->numberFormatStyle,
            'locale' => $this->locale instanceof AbstractTransfer ? $this->locale->toArray(true, true) : $this->locale,
        ];
    }
}
