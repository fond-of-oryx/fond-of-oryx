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
class KeyTranslationTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const GLOSSARY_KEY = 'glossaryKey';

    /**
     * @var string
     */
    public const LOCALES = 'locales';

    /**
     * @var string|int|null
     */
    protected $glossaryKey;

    /**
     * @var array
     */
    protected $locales = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'glossary_key' => 'glossaryKey',
        'glossaryKey' => 'glossaryKey',
        'GlossaryKey' => 'glossaryKey',
        'locales' => 'locales',
        'Locales' => 'locales',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::GLOSSARY_KEY => [
            'type' => 'int',
            'type_shim' => 'string',
            'name_underscore' => 'glossary_key',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LOCALES => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'locales',
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
     * @module Glossary
     *
     * @param string|int|null $glossaryKey Forward compatibility warning: string is the actual type (please use that, int is kept for BC).
     *
     * @return $this
     */
    public function setGlossaryKey($glossaryKey)
    {
        $this->glossaryKey = $glossaryKey;
        $this->modifiedProperties[self::GLOSSARY_KEY] = true;

        return $this;
    }

    /**
     * @module Glossary
     *
     * @return string|int|null Forward compatibility warning: string is the actual type (please use that, int is kept for BC).
     */
    public function getGlossaryKey()
    {
        return $this->glossaryKey;
    }

    /**
     * @module Glossary
     *
     * @param string|int|null $glossaryKey Forward compatibility warning: string is the actual type (please use that, int is kept for BC).
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setGlossaryKeyOrFail($glossaryKey)
    {
        if ($glossaryKey === null) {
            $this->throwNullValueException(static::GLOSSARY_KEY);
        }

        return $this->setGlossaryKey($glossaryKey);
    }

    /**
     * @module Glossary
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getGlossaryKeyOrFail()
    {
        if ($this->glossaryKey === null) {
            $this->throwNullValueException(static::GLOSSARY_KEY);
        }

        return $this->glossaryKey;
    }

    /**
     * @module Glossary
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireGlossaryKey()
    {
        $this->assertPropertyIsSet(self::GLOSSARY_KEY);

        return $this;
    }

    /**
     * @module Glossary
     *
     * @param array|null $locales
     *
     * @return $this
     */
    public function setLocales(array $locales = null)
    {
        if ($locales === null) {
            $locales = [];
        }

        $this->locales = $locales;
        $this->modifiedProperties[self::LOCALES] = true;

        return $this;
    }

    /**
     * @module Glossary
     *
     * @return array
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * @module Glossary
     *
     * @param mixed $locales
     *
     * @return $this
     */
    public function addLocales($locales)
    {
        $this->locales[] = $locales;
        $this->modifiedProperties[self::LOCALES] = true;

        return $this;
    }

    /**
     * @module Glossary
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLocales()
    {
        $this->assertPropertyIsSet(self::LOCALES);

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
                case 'glossaryKey':
                case 'locales':
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
                case 'glossaryKey':
                case 'locales':
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
                case 'glossaryKey':
                case 'locales':
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
            'glossaryKey' => $this->glossaryKey,
            'locales' => $this->locales,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'glossary_key' => $this->glossaryKey,
            'locales' => $this->locales,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'glossary_key' => $this->glossaryKey instanceof AbstractTransfer ? $this->glossaryKey->toArray(true, false) : $this->glossaryKey,
            'locales' => $this->locales instanceof AbstractTransfer ? $this->locales->toArray(true, false) : $this->locales,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'glossaryKey' => $this->glossaryKey instanceof AbstractTransfer ? $this->glossaryKey->toArray(true, true) : $this->glossaryKey,
            'locales' => $this->locales instanceof AbstractTransfer ? $this->locales->toArray(true, true) : $this->locales,
        ];
    }
}
