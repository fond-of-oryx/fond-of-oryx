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
class PaginationConfigTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const PARAMETER_NAME = 'parameterName';

    /**
     * @var string
     */
    public const ITEMS_PER_PAGE_PARAMETER_NAME = 'itemsPerPageParameterName';

    /**
     * @var string
     */
    public const DEFAULT_ITEMS_PER_PAGE = 'defaultItemsPerPage';

    /**
     * @var string
     */
    public const VALID_ITEMS_PER_PAGE_OPTIONS = 'validItemsPerPageOptions';

    /**
     * @var string|null
     */
    protected $parameterName;

    /**
     * @var string|null
     */
    protected $itemsPerPageParameterName;

    /**
     * @var int|null
     */
    protected $defaultItemsPerPage;

    /**
     * @var array
     */
    protected $validItemsPerPageOptions = [];

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'parameter_name' => 'parameterName',
        'parameterName' => 'parameterName',
        'ParameterName' => 'parameterName',
        'items_per_page_parameter_name' => 'itemsPerPageParameterName',
        'itemsPerPageParameterName' => 'itemsPerPageParameterName',
        'ItemsPerPageParameterName' => 'itemsPerPageParameterName',
        'default_items_per_page' => 'defaultItemsPerPage',
        'defaultItemsPerPage' => 'defaultItemsPerPage',
        'DefaultItemsPerPage' => 'defaultItemsPerPage',
        'valid_items_per_page_options' => 'validItemsPerPageOptions',
        'validItemsPerPageOptions' => 'validItemsPerPageOptions',
        'ValidItemsPerPageOptions' => 'validItemsPerPageOptions',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::PARAMETER_NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'parameter_name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ITEMS_PER_PAGE_PARAMETER_NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'items_per_page_parameter_name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::DEFAULT_ITEMS_PER_PAGE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'default_items_per_page',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::VALID_ITEMS_PER_PAGE_OPTIONS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'valid_items_per_page_options',
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
     * @param string|null $parameterName
     *
     * @return $this
     */
    public function setParameterName($parameterName)
    {
        $this->parameterName = $parameterName;
        $this->modifiedProperties[self::PARAMETER_NAME] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return string|null
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $parameterName
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setParameterNameOrFail($parameterName)
    {
        if ($parameterName === null) {
            $this->throwNullValueException(static::PARAMETER_NAME);
        }

        return $this->setParameterName($parameterName);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getParameterNameOrFail()
    {
        if ($this->parameterName === null) {
            $this->throwNullValueException(static::PARAMETER_NAME);
        }

        return $this->parameterName;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireParameterName()
    {
        $this->assertPropertyIsSet(self::PARAMETER_NAME);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $itemsPerPageParameterName
     *
     * @return $this
     */
    public function setItemsPerPageParameterName($itemsPerPageParameterName)
    {
        $this->itemsPerPageParameterName = $itemsPerPageParameterName;
        $this->modifiedProperties[self::ITEMS_PER_PAGE_PARAMETER_NAME] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return string|null
     */
    public function getItemsPerPageParameterName()
    {
        return $this->itemsPerPageParameterName;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param string|null $itemsPerPageParameterName
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setItemsPerPageParameterNameOrFail($itemsPerPageParameterName)
    {
        if ($itemsPerPageParameterName === null) {
            $this->throwNullValueException(static::ITEMS_PER_PAGE_PARAMETER_NAME);
        }

        return $this->setItemsPerPageParameterName($itemsPerPageParameterName);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getItemsPerPageParameterNameOrFail()
    {
        if ($this->itemsPerPageParameterName === null) {
            $this->throwNullValueException(static::ITEMS_PER_PAGE_PARAMETER_NAME);
        }

        return $this->itemsPerPageParameterName;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireItemsPerPageParameterName()
    {
        $this->assertPropertyIsSet(self::ITEMS_PER_PAGE_PARAMETER_NAME);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $defaultItemsPerPage
     *
     * @return $this
     */
    public function setDefaultItemsPerPage($defaultItemsPerPage)
    {
        $this->defaultItemsPerPage = $defaultItemsPerPage;
        $this->modifiedProperties[self::DEFAULT_ITEMS_PER_PAGE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return int|null
     */
    public function getDefaultItemsPerPage()
    {
        return $this->defaultItemsPerPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $defaultItemsPerPage
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDefaultItemsPerPageOrFail($defaultItemsPerPage)
    {
        if ($defaultItemsPerPage === null) {
            $this->throwNullValueException(static::DEFAULT_ITEMS_PER_PAGE);
        }

        return $this->setDefaultItemsPerPage($defaultItemsPerPage);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getDefaultItemsPerPageOrFail()
    {
        if ($this->defaultItemsPerPage === null) {
            $this->throwNullValueException(static::DEFAULT_ITEMS_PER_PAGE);
        }

        return $this->defaultItemsPerPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDefaultItemsPerPage()
    {
        $this->assertPropertyIsSet(self::DEFAULT_ITEMS_PER_PAGE);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param array|null $validItemsPerPageOptions
     *
     * @return $this
     */
    public function setValidItemsPerPageOptions(array $validItemsPerPageOptions = null)
    {
        if ($validItemsPerPageOptions === null) {
            $validItemsPerPageOptions = [];
        }

        $this->validItemsPerPageOptions = $validItemsPerPageOptions;
        $this->modifiedProperties[self::VALID_ITEMS_PER_PAGE_OPTIONS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return array
     */
    public function getValidItemsPerPageOptions()
    {
        return $this->validItemsPerPageOptions;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param mixed $validItemsPerPageOptions
     *
     * @return $this
     */
    public function addValidItemsPerPageOptions($validItemsPerPageOptions)
    {
        $this->validItemsPerPageOptions[] = $validItemsPerPageOptions;
        $this->modifiedProperties[self::VALID_ITEMS_PER_PAGE_OPTIONS] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireValidItemsPerPageOptions()
    {
        $this->assertPropertyIsSet(self::VALID_ITEMS_PER_PAGE_OPTIONS);

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
                case 'parameterName':
                case 'itemsPerPageParameterName':
                case 'defaultItemsPerPage':
                case 'validItemsPerPageOptions':
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
                case 'parameterName':
                case 'itemsPerPageParameterName':
                case 'defaultItemsPerPage':
                case 'validItemsPerPageOptions':
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
                case 'parameterName':
                case 'itemsPerPageParameterName':
                case 'defaultItemsPerPage':
                case 'validItemsPerPageOptions':
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
            'parameterName' => $this->parameterName,
            'itemsPerPageParameterName' => $this->itemsPerPageParameterName,
            'defaultItemsPerPage' => $this->defaultItemsPerPage,
            'validItemsPerPageOptions' => $this->validItemsPerPageOptions,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'parameter_name' => $this->parameterName,
            'items_per_page_parameter_name' => $this->itemsPerPageParameterName,
            'default_items_per_page' => $this->defaultItemsPerPage,
            'valid_items_per_page_options' => $this->validItemsPerPageOptions,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'parameter_name' => $this->parameterName instanceof AbstractTransfer ? $this->parameterName->toArray(true, false) : $this->parameterName,
            'items_per_page_parameter_name' => $this->itemsPerPageParameterName instanceof AbstractTransfer ? $this->itemsPerPageParameterName->toArray(true, false) : $this->itemsPerPageParameterName,
            'default_items_per_page' => $this->defaultItemsPerPage instanceof AbstractTransfer ? $this->defaultItemsPerPage->toArray(true, false) : $this->defaultItemsPerPage,
            'valid_items_per_page_options' => $this->validItemsPerPageOptions instanceof AbstractTransfer ? $this->validItemsPerPageOptions->toArray(true, false) : $this->validItemsPerPageOptions,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'parameterName' => $this->parameterName instanceof AbstractTransfer ? $this->parameterName->toArray(true, true) : $this->parameterName,
            'itemsPerPageParameterName' => $this->itemsPerPageParameterName instanceof AbstractTransfer ? $this->itemsPerPageParameterName->toArray(true, true) : $this->itemsPerPageParameterName,
            'defaultItemsPerPage' => $this->defaultItemsPerPage instanceof AbstractTransfer ? $this->defaultItemsPerPage->toArray(true, true) : $this->defaultItemsPerPage,
            'validItemsPerPageOptions' => $this->validItemsPerPageOptions instanceof AbstractTransfer ? $this->validItemsPerPageOptions->toArray(true, true) : $this->validItemsPerPageOptions,
        ];
    }
}
