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
class SpyLocaleEntityTransfer extends AbstractEntityTransfer
{
    /**
     * @var string
     */
    public const ID_LOCALE = 'idLocale';

    /**
     * @var string
     */
    public const LOCALE_NAME = 'localeName';

    /**
     * @var string
     */
    public const IS_ACTIVE = 'isActive';

    /**
     * @var string
     */
    public const SPY_CUSTOMERS = 'spyCustomers';

    /**
     * @var string
     */
    public const SPY_TOUCH_STORAGES = 'spyTouchStorages';

    /**
     * @var string
     */
    public const SPY_TOUCH_SEARCHES = 'spyTouchSearches';

    /**
     * @var string
     */
    public const SPY_GLOSSARY_TRANSLATIONS = 'spyGlossaryTranslations';

    /**
     * @var integer|null
     */
    protected $idLocale;

    /**
     * @var string|null
     */
    protected $localeName;

    /**
     * @var boolean|null
     */
    protected $isActive;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SpyCustomerEntityTransfer[]
     */
    protected $spyCustomers;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SpyTouchStorageEntityTransfer[]
     */
    protected $spyTouchStorages;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SpyTouchSearchEntityTransfer[]
     */
    protected $spyTouchSearches;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SpyGlossaryTranslationEntityTransfer[]
     */
    protected $spyGlossaryTranslations;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'id_locale' => 'idLocale',
        'idLocale' => 'idLocale',
        'IdLocale' => 'idLocale',
        'locale_name' => 'localeName',
        'localeName' => 'localeName',
        'LocaleName' => 'localeName',
        'is_active' => 'isActive',
        'isActive' => 'isActive',
        'IsActive' => 'isActive',
        'spy_customers' => 'spyCustomers',
        'spyCustomers' => 'spyCustomers',
        'SpyCustomers' => 'spyCustomers',
        'spy_touch_storages' => 'spyTouchStorages',
        'spyTouchStorages' => 'spyTouchStorages',
        'SpyTouchStorages' => 'spyTouchStorages',
        'spy_touch_searches' => 'spyTouchSearches',
        'spyTouchSearches' => 'spyTouchSearches',
        'SpyTouchSearches' => 'spyTouchSearches',
        'spy_glossary_translations' => 'spyGlossaryTranslations',
        'spyGlossaryTranslations' => 'spyGlossaryTranslations',
        'SpyGlossaryTranslations' => 'spyGlossaryTranslations',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::ID_LOCALE => [
            'type' => 'integer',
            'type_shim' => null,
            'name_underscore' => 'id_locale',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LOCALE_NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'locale_name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::IS_ACTIVE => [
            'type' => 'boolean',
            'type_shim' => null,
            'name_underscore' => 'is_active',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SPY_CUSTOMERS => [
            'type' => 'Generated\Shared\Transfer\SpyCustomerEntityTransfer',
            'type_shim' => null,
            'name_underscore' => 'spy_customers',
            'is_collection' => true,
            'is_transfer' => true,
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
        self::SPY_GLOSSARY_TRANSLATIONS => [
            'type' => 'Generated\Shared\Transfer\SpyGlossaryTranslationEntityTransfer',
            'type_shim' => null,
            'name_underscore' => 'spy_glossary_translations',
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
    public static $entityNamespace = 'Orm\Zed\Locale\Persistence\SpyLocale';


    /**
     * @module 
     *
     * @param integer|null $idLocale
     *
     * @return $this
     */
    public function setIdLocale($idLocale)
    {
        $this->idLocale = $idLocale;
        $this->modifiedProperties[self::ID_LOCALE] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return integer|null
     */
    public function getIdLocale()
    {
        return $this->idLocale;
    }

    /**
     * @module 
     *
     * @param integer|null $idLocale
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIdLocaleOrFail($idLocale)
    {
        if ($idLocale === null) {
            $this->throwNullValueException(static::ID_LOCALE);
        }

        return $this->setIdLocale($idLocale);
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return integer
     */
    public function getIdLocaleOrFail()
    {
        if ($this->idLocale === null) {
            $this->throwNullValueException(static::ID_LOCALE);
        }

        return $this->idLocale;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIdLocale()
    {
        $this->assertPropertyIsSet(self::ID_LOCALE);

        return $this;
    }

    /**
     * @module 
     *
     * @param string|null $localeName
     *
     * @return $this
     */
    public function setLocaleName($localeName)
    {
        $this->localeName = $localeName;
        $this->modifiedProperties[self::LOCALE_NAME] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return string|null
     */
    public function getLocaleName()
    {
        return $this->localeName;
    }

    /**
     * @module 
     *
     * @param string|null $localeName
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLocaleNameOrFail($localeName)
    {
        if ($localeName === null) {
            $this->throwNullValueException(static::LOCALE_NAME);
        }

        return $this->setLocaleName($localeName);
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getLocaleNameOrFail()
    {
        if ($this->localeName === null) {
            $this->throwNullValueException(static::LOCALE_NAME);
        }

        return $this->localeName;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLocaleName()
    {
        $this->assertPropertyIsSet(self::LOCALE_NAME);

        return $this;
    }

    /**
     * @module 
     *
     * @param boolean|null $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        $this->modifiedProperties[self::IS_ACTIVE] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return boolean|null
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @module 
     *
     * @param boolean|null $isActive
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIsActiveOrFail($isActive)
    {
        if ($isActive === null) {
            $this->throwNullValueException(static::IS_ACTIVE);
        }

        return $this->setIsActive($isActive);
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return boolean
     */
    public function getIsActiveOrFail()
    {
        if ($this->isActive === null) {
            $this->throwNullValueException(static::IS_ACTIVE);
        }

        return $this->isActive;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIsActive()
    {
        $this->assertPropertyIsSet(self::IS_ACTIVE);

        return $this;
    }

    /**
     * @module 
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SpyCustomerEntityTransfer[] $spyCustomers
     *
     * @return $this
     */
    public function setSpyCustomers(ArrayObject $spyCustomers)
    {
        $this->spyCustomers = $spyCustomers;
        $this->modifiedProperties[self::SPY_CUSTOMERS] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SpyCustomerEntityTransfer[]
     */
    public function getSpyCustomers()
    {
        return $this->spyCustomers;
    }

    /**
     * @module 
     *
     * @param \Generated\Shared\Transfer\SpyCustomerEntityTransfer $spyCustomers
     *
     * @return $this
     */
    public function addSpyCustomers(SpyCustomerEntityTransfer $spyCustomers)
    {
        $this->spyCustomers[] = $spyCustomers;
        $this->modifiedProperties[self::SPY_CUSTOMERS] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSpyCustomers()
    {
        $this->assertCollectionPropertyIsSet(self::SPY_CUSTOMERS);

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
     * @module 
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SpyGlossaryTranslationEntityTransfer[] $spyGlossaryTranslations
     *
     * @return $this
     */
    public function setSpyGlossaryTranslations(ArrayObject $spyGlossaryTranslations)
    {
        $this->spyGlossaryTranslations = $spyGlossaryTranslations;
        $this->modifiedProperties[self::SPY_GLOSSARY_TRANSLATIONS] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SpyGlossaryTranslationEntityTransfer[]
     */
    public function getSpyGlossaryTranslations()
    {
        return $this->spyGlossaryTranslations;
    }

    /**
     * @module 
     *
     * @param \Generated\Shared\Transfer\SpyGlossaryTranslationEntityTransfer $spyGlossaryTranslations
     *
     * @return $this
     */
    public function addSpyGlossaryTranslations(SpyGlossaryTranslationEntityTransfer $spyGlossaryTranslations)
    {
        $this->spyGlossaryTranslations[] = $spyGlossaryTranslations;
        $this->modifiedProperties[self::SPY_GLOSSARY_TRANSLATIONS] = true;

        return $this;
    }

    /**
     * @module 
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSpyGlossaryTranslations()
    {
        $this->assertCollectionPropertyIsSet(self::SPY_GLOSSARY_TRANSLATIONS);

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
                case 'idLocale':
                case 'localeName':
                case 'isActive':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'spyCustomers':
                case 'spyTouchStorages':
                case 'spyTouchSearches':
                case 'spyGlossaryTranslations':
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
                case 'idLocale':
                case 'localeName':
                case 'isActive':
                    $values[$arrayKey] = $value;

                    break;
                case 'spyCustomers':
                case 'spyTouchStorages':
                case 'spyTouchSearches':
                case 'spyGlossaryTranslations':
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
                case 'idLocale':
                case 'localeName':
                case 'isActive':
                    $values[$arrayKey] = $value;

                    break;
                case 'spyCustomers':
                case 'spyTouchStorages':
                case 'spyTouchSearches':
                case 'spyGlossaryTranslations':
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
        $this->spyCustomers = $this->spyCustomers ?: new ArrayObject();
        $this->spyTouchStorages = $this->spyTouchStorages ?: new ArrayObject();
        $this->spyTouchSearches = $this->spyTouchSearches ?: new ArrayObject();
        $this->spyGlossaryTranslations = $this->spyGlossaryTranslations ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'idLocale' => $this->idLocale,
            'localeName' => $this->localeName,
            'isActive' => $this->isActive,
            'spyCustomers' => $this->spyCustomers,
            'spyTouchStorages' => $this->spyTouchStorages,
            'spyTouchSearches' => $this->spyTouchSearches,
            'spyGlossaryTranslations' => $this->spyGlossaryTranslations,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'id_locale' => $this->idLocale,
            'locale_name' => $this->localeName,
            'is_active' => $this->isActive,
            'spy_customers' => $this->spyCustomers,
            'spy_touch_storages' => $this->spyTouchStorages,
            'spy_touch_searches' => $this->spyTouchSearches,
            'spy_glossary_translations' => $this->spyGlossaryTranslations,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'id_locale' => $this->idLocale instanceof AbstractTransfer ? $this->idLocale->toArray(true, false) : $this->idLocale,
            'locale_name' => $this->localeName instanceof AbstractTransfer ? $this->localeName->toArray(true, false) : $this->localeName,
            'is_active' => $this->isActive instanceof AbstractTransfer ? $this->isActive->toArray(true, false) : $this->isActive,
            'spy_customers' => $this->spyCustomers instanceof AbstractTransfer ? $this->spyCustomers->toArray(true, false) : $this->addValuesToCollection($this->spyCustomers, true, false),
            'spy_touch_storages' => $this->spyTouchStorages instanceof AbstractTransfer ? $this->spyTouchStorages->toArray(true, false) : $this->addValuesToCollection($this->spyTouchStorages, true, false),
            'spy_touch_searches' => $this->spyTouchSearches instanceof AbstractTransfer ? $this->spyTouchSearches->toArray(true, false) : $this->addValuesToCollection($this->spyTouchSearches, true, false),
            'spy_glossary_translations' => $this->spyGlossaryTranslations instanceof AbstractTransfer ? $this->spyGlossaryTranslations->toArray(true, false) : $this->addValuesToCollection($this->spyGlossaryTranslations, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'idLocale' => $this->idLocale instanceof AbstractTransfer ? $this->idLocale->toArray(true, true) : $this->idLocale,
            'localeName' => $this->localeName instanceof AbstractTransfer ? $this->localeName->toArray(true, true) : $this->localeName,
            'isActive' => $this->isActive instanceof AbstractTransfer ? $this->isActive->toArray(true, true) : $this->isActive,
            'spyCustomers' => $this->spyCustomers instanceof AbstractTransfer ? $this->spyCustomers->toArray(true, true) : $this->addValuesToCollection($this->spyCustomers, true, true),
            'spyTouchStorages' => $this->spyTouchStorages instanceof AbstractTransfer ? $this->spyTouchStorages->toArray(true, true) : $this->addValuesToCollection($this->spyTouchStorages, true, true),
            'spyTouchSearches' => $this->spyTouchSearches instanceof AbstractTransfer ? $this->spyTouchSearches->toArray(true, true) : $this->addValuesToCollection($this->spyTouchSearches, true, true),
            'spyGlossaryTranslations' => $this->spyGlossaryTranslations instanceof AbstractTransfer ? $this->spyGlossaryTranslations->toArray(true, true) : $this->addValuesToCollection($this->spyGlossaryTranslations, true, true),
        ];
    }
}
