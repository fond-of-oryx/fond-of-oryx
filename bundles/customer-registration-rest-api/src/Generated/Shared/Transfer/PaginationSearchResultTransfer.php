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
class PaginationSearchResultTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const NUM_FOUND = 'numFound';

    /**
     * @var string
     */
    public const CURRENT_PAGE = 'currentPage';

    /**
     * @var string
     */
    public const MAX_PAGE = 'maxPage';

    /**
     * @var string
     */
    public const CURRENT_ITEMS_PER_PAGE = 'currentItemsPerPage';

    /**
     * @var string
     */
    public const CONFIG = 'config';

    /**
     * @var int|null
     */
    protected $numFound;

    /**
     * @var int|null
     */
    protected $currentPage;

    /**
     * @var int|null
     */
    protected $maxPage;

    /**
     * @var int|null
     */
    protected $currentItemsPerPage;

    /**
     * @var \Generated\Shared\Transfer\PaginationConfigTransfer|null
     */
    protected $config;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'num_found' => 'numFound',
        'numFound' => 'numFound',
        'NumFound' => 'numFound',
        'current_page' => 'currentPage',
        'currentPage' => 'currentPage',
        'CurrentPage' => 'currentPage',
        'max_page' => 'maxPage',
        'maxPage' => 'maxPage',
        'MaxPage' => 'maxPage',
        'current_items_per_page' => 'currentItemsPerPage',
        'currentItemsPerPage' => 'currentItemsPerPage',
        'CurrentItemsPerPage' => 'currentItemsPerPage',
        'config' => 'config',
        'Config' => 'config',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::NUM_FOUND => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'num_found',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CURRENT_PAGE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'current_page',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::MAX_PAGE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'max_page',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CURRENT_ITEMS_PER_PAGE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'current_items_per_page',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CONFIG => [
            'type' => 'Generated\Shared\Transfer\PaginationConfigTransfer',
            'type_shim' => null,
            'name_underscore' => 'config',
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
     * @module SearchElasticsearch|Search
     *
     * @param int|null $numFound
     *
     * @return $this
     */
    public function setNumFound($numFound)
    {
        $this->numFound = $numFound;
        $this->modifiedProperties[self::NUM_FOUND] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return int|null
     */
    public function getNumFound()
    {
        return $this->numFound;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $numFound
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setNumFoundOrFail($numFound)
    {
        if ($numFound === null) {
            $this->throwNullValueException(static::NUM_FOUND);
        }

        return $this->setNumFound($numFound);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getNumFoundOrFail()
    {
        if ($this->numFound === null) {
            $this->throwNullValueException(static::NUM_FOUND);
        }

        return $this->numFound;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireNumFound()
    {
        $this->assertPropertyIsSet(self::NUM_FOUND);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $currentPage
     *
     * @return $this
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        $this->modifiedProperties[self::CURRENT_PAGE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return int|null
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $currentPage
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCurrentPageOrFail($currentPage)
    {
        if ($currentPage === null) {
            $this->throwNullValueException(static::CURRENT_PAGE);
        }

        return $this->setCurrentPage($currentPage);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getCurrentPageOrFail()
    {
        if ($this->currentPage === null) {
            $this->throwNullValueException(static::CURRENT_PAGE);
        }

        return $this->currentPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCurrentPage()
    {
        $this->assertPropertyIsSet(self::CURRENT_PAGE);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $maxPage
     *
     * @return $this
     */
    public function setMaxPage($maxPage)
    {
        $this->maxPage = $maxPage;
        $this->modifiedProperties[self::MAX_PAGE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return int|null
     */
    public function getMaxPage()
    {
        return $this->maxPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $maxPage
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setMaxPageOrFail($maxPage)
    {
        if ($maxPage === null) {
            $this->throwNullValueException(static::MAX_PAGE);
        }

        return $this->setMaxPage($maxPage);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getMaxPageOrFail()
    {
        if ($this->maxPage === null) {
            $this->throwNullValueException(static::MAX_PAGE);
        }

        return $this->maxPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireMaxPage()
    {
        $this->assertPropertyIsSet(self::MAX_PAGE);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $currentItemsPerPage
     *
     * @return $this
     */
    public function setCurrentItemsPerPage($currentItemsPerPage)
    {
        $this->currentItemsPerPage = $currentItemsPerPage;
        $this->modifiedProperties[self::CURRENT_ITEMS_PER_PAGE] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return int|null
     */
    public function getCurrentItemsPerPage()
    {
        return $this->currentItemsPerPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param int|null $currentItemsPerPage
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCurrentItemsPerPageOrFail($currentItemsPerPage)
    {
        if ($currentItemsPerPage === null) {
            $this->throwNullValueException(static::CURRENT_ITEMS_PER_PAGE);
        }

        return $this->setCurrentItemsPerPage($currentItemsPerPage);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getCurrentItemsPerPageOrFail()
    {
        if ($this->currentItemsPerPage === null) {
            $this->throwNullValueException(static::CURRENT_ITEMS_PER_PAGE);
        }

        return $this->currentItemsPerPage;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCurrentItemsPerPage()
    {
        $this->assertPropertyIsSet(self::CURRENT_ITEMS_PER_PAGE);

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\PaginationConfigTransfer|null $config
     *
     * @return $this
     */
    public function setConfig(PaginationConfigTransfer $config = null)
    {
        $this->config = $config;
        $this->modifiedProperties[self::CONFIG] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @param \Generated\Shared\Transfer\PaginationConfigTransfer $config
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setConfigOrFail(PaginationConfigTransfer $config)
    {
        return $this->setConfig($config);
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\PaginationConfigTransfer
     */
    public function getConfigOrFail()
    {
        if ($this->config === null) {
            $this->throwNullValueException(static::CONFIG);
        }

        return $this->config;
    }

    /**
     * @module SearchElasticsearch|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireConfig()
    {
        $this->assertPropertyIsSet(self::CONFIG);

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
                case 'numFound':
                case 'currentPage':
                case 'maxPage':
                case 'currentItemsPerPage':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'config':
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
                case 'numFound':
                case 'currentPage':
                case 'maxPage':
                case 'currentItemsPerPage':
                    $values[$arrayKey] = $value;

                    break;
                case 'config':
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
                case 'numFound':
                case 'currentPage':
                case 'maxPage':
                case 'currentItemsPerPage':
                    $values[$arrayKey] = $value;

                    break;
                case 'config':
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
            'numFound' => $this->numFound,
            'currentPage' => $this->currentPage,
            'maxPage' => $this->maxPage,
            'currentItemsPerPage' => $this->currentItemsPerPage,
            'config' => $this->config,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'num_found' => $this->numFound,
            'current_page' => $this->currentPage,
            'max_page' => $this->maxPage,
            'current_items_per_page' => $this->currentItemsPerPage,
            'config' => $this->config,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'num_found' => $this->numFound instanceof AbstractTransfer ? $this->numFound->toArray(true, false) : $this->numFound,
            'current_page' => $this->currentPage instanceof AbstractTransfer ? $this->currentPage->toArray(true, false) : $this->currentPage,
            'max_page' => $this->maxPage instanceof AbstractTransfer ? $this->maxPage->toArray(true, false) : $this->maxPage,
            'current_items_per_page' => $this->currentItemsPerPage instanceof AbstractTransfer ? $this->currentItemsPerPage->toArray(true, false) : $this->currentItemsPerPage,
            'config' => $this->config instanceof AbstractTransfer ? $this->config->toArray(true, false) : $this->config,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'numFound' => $this->numFound instanceof AbstractTransfer ? $this->numFound->toArray(true, true) : $this->numFound,
            'currentPage' => $this->currentPage instanceof AbstractTransfer ? $this->currentPage->toArray(true, true) : $this->currentPage,
            'maxPage' => $this->maxPage instanceof AbstractTransfer ? $this->maxPage->toArray(true, true) : $this->maxPage,
            'currentItemsPerPage' => $this->currentItemsPerPage instanceof AbstractTransfer ? $this->currentItemsPerPage->toArray(true, true) : $this->currentItemsPerPage,
            'config' => $this->config instanceof AbstractTransfer ? $this->config->toArray(true, true) : $this->config,
        ];
    }
}
