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
class PageMapTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const SEARCH_RESULT_DATA = 'searchResultData';

    /**
     * @var string
     */
    public const TYPE = 'type';

    /**
     * @var string
     */
    public const STORE = 'store';

    /**
     * @var string
     */
    public const LOCALE = 'locale';

    /**
     * @var string
     */
    public const FULL_TEXT = 'fullText';

    /**
     * @var string
     */
    public const FULL_TEXT_BOOSTED = 'fullTextBoosted';

    /**
     * @var string
     */
    public const STRING_FACET = 'stringFacet';

    /**
     * @var string
     */
    public const INTEGER_FACET = 'integerFacet';

    /**
     * @var string
     */
    public const COMPLETION_TERMS = 'completionTerms';

    /**
     * @var string
     */
    public const SUGGESTION_TERMS = 'suggestionTerms';

    /**
     * @var string
     */
    public const STRING_SORT = 'stringSort';

    /**
     * @var string
     */
    public const INTEGER_SORT = 'integerSort';

    /**
     * @var string
     */
    public const CATEGORY = 'category';

    /**
     * @var string
     */
    public const IS_ACTIVE = 'isActive';

    /**
     * @var string
     */
    public const ACTIVE_FROM = 'activeFrom';

    /**
     * @var string
     */
    public const ACTIVE_TO = 'activeTo';

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SearchResultDataMapTransfer[]
     */
    protected $searchResultData;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var string|null
     */
    protected $store;

    /**
     * @var string|null
     */
    protected $locale;

    /**
     * @var array
     */
    protected $fullText = [];

    /**
     * @var array
     */
    protected $fullTextBoosted = [];

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\StringFacetMapTransfer[]
     */
    protected $stringFacet;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\IntegerFacetMapTransfer[]
     */
    protected $integerFacet;

    /**
     * @var array
     */
    protected $completionTerms = [];

    /**
     * @var array
     */
    protected $suggestionTerms = [];

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\StringSortMapTransfer[]
     */
    protected $stringSort;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\IntegerSortMapTransfer[]
     */
    protected $integerSort;

    /**
     * @var \Generated\Shared\Transfer\CategoryMapTransfer|null
     */
    protected $category;

    /**
     * @var bool|null
     */
    protected $isActive;

    /**
     * @var string|null
     */
    protected $activeFrom;

    /**
     * @var string|null
     */
    protected $activeTo;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'search_result_data' => 'searchResultData',
        'searchResultData' => 'searchResultData',
        'SearchResultData' => 'searchResultData',
        'type' => 'type',
        'Type' => 'type',
        'store' => 'store',
        'Store' => 'store',
        'locale' => 'locale',
        'Locale' => 'locale',
        'full_text' => 'fullText',
        'fullText' => 'fullText',
        'FullText' => 'fullText',
        'full_text_boosted' => 'fullTextBoosted',
        'fullTextBoosted' => 'fullTextBoosted',
        'FullTextBoosted' => 'fullTextBoosted',
        'string_facet' => 'stringFacet',
        'stringFacet' => 'stringFacet',
        'StringFacet' => 'stringFacet',
        'integer_facet' => 'integerFacet',
        'integerFacet' => 'integerFacet',
        'IntegerFacet' => 'integerFacet',
        'completion_terms' => 'completionTerms',
        'completionTerms' => 'completionTerms',
        'CompletionTerms' => 'completionTerms',
        'suggestion_terms' => 'suggestionTerms',
        'suggestionTerms' => 'suggestionTerms',
        'SuggestionTerms' => 'suggestionTerms',
        'string_sort' => 'stringSort',
        'stringSort' => 'stringSort',
        'StringSort' => 'stringSort',
        'integer_sort' => 'integerSort',
        'integerSort' => 'integerSort',
        'IntegerSort' => 'integerSort',
        'category' => 'category',
        'Category' => 'category',
        'is_active' => 'isActive',
        'isActive' => 'isActive',
        'IsActive' => 'isActive',
        'active_from' => 'activeFrom',
        'activeFrom' => 'activeFrom',
        'ActiveFrom' => 'activeFrom',
        'active_to' => 'activeTo',
        'activeTo' => 'activeTo',
        'ActiveTo' => 'activeTo',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::SEARCH_RESULT_DATA => [
            'type' => 'Generated\Shared\Transfer\SearchResultDataMapTransfer',
            'type_shim' => null,
            'name_underscore' => 'search_result_data',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::TYPE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'type',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::STORE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'store',
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
        self::FULL_TEXT => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'full_text',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::FULL_TEXT_BOOSTED => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'full_text_boosted',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::STRING_FACET => [
            'type' => 'Generated\Shared\Transfer\StringFacetMapTransfer',
            'type_shim' => null,
            'name_underscore' => 'string_facet',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::INTEGER_FACET => [
            'type' => 'Generated\Shared\Transfer\IntegerFacetMapTransfer',
            'type_shim' => null,
            'name_underscore' => 'integer_facet',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::COMPLETION_TERMS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'completion_terms',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SUGGESTION_TERMS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'suggestion_terms',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::STRING_SORT => [
            'type' => 'Generated\Shared\Transfer\StringSortMapTransfer',
            'type_shim' => null,
            'name_underscore' => 'string_sort',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::INTEGER_SORT => [
            'type' => 'Generated\Shared\Transfer\IntegerSortMapTransfer',
            'type_shim' => null,
            'name_underscore' => 'integer_sort',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CATEGORY => [
            'type' => 'Generated\Shared\Transfer\CategoryMapTransfer',
            'type_shim' => null,
            'name_underscore' => 'category',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::IS_ACTIVE => [
            'type' => 'bool',
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
        self::ACTIVE_FROM => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'active_from',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ACTIVE_TO => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'active_to',
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
     * @param \ArrayObject|\Generated\Shared\Transfer\SearchResultDataMapTransfer[] $searchResultData
     *
     * @return $this
     */
    public function setSearchResultData(ArrayObject $searchResultData)
    {
        $this->searchResultData = $searchResultData;
        $this->modifiedProperties[self::SEARCH_RESULT_DATA] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SearchResultDataMapTransfer[]
     */
    public function getSearchResultData()
    {
        return $this->searchResultData;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\SearchResultDataMapTransfer $searchResultData
     *
     * @return $this
     */
    public function addSearchResultData(SearchResultDataMapTransfer $searchResultData)
    {
        $this->searchResultData[] = $searchResultData;
        $this->modifiedProperties[self::SEARCH_RESULT_DATA] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSearchResultData()
    {
        $this->assertCollectionPropertyIsSet(self::SEARCH_RESULT_DATA);

        return $this;
    }

    /**
     * @module Search
     *
     * @param string|null $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        $this->modifiedProperties[self::TYPE] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @module Search
     *
     * @param string|null $type
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setTypeOrFail($type)
    {
        if ($type === null) {
            $this->throwNullValueException(static::TYPE);
        }

        return $this->setType($type);
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getTypeOrFail()
    {
        if ($this->type === null) {
            $this->throwNullValueException(static::TYPE);
        }

        return $this->type;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireType()
    {
        $this->assertPropertyIsSet(self::TYPE);

        return $this;
    }

    /**
     * @module Search
     *
     * @param string|null $store
     *
     * @return $this
     */
    public function setStore($store)
    {
        $this->store = $store;
        $this->modifiedProperties[self::STORE] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return string|null
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @module Search
     *
     * @param string|null $store
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setStoreOrFail($store)
    {
        if ($store === null) {
            $this->throwNullValueException(static::STORE);
        }

        return $this->setStore($store);
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getStoreOrFail()
    {
        if ($this->store === null) {
            $this->throwNullValueException(static::STORE);
        }

        return $this->store;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireStore()
    {
        $this->assertPropertyIsSet(self::STORE);

        return $this;
    }

    /**
     * @module Search
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
     * @module Search
     *
     * @return string|null
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @module Search
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
     * @module Search
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
     * @module Search
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
     * @module Search
     *
     * @param array|null $fullText
     *
     * @return $this
     */
    public function setFullText(array $fullText = null)
    {
        if ($fullText === null) {
            $fullText = [];
        }

        $this->fullText = $fullText;
        $this->modifiedProperties[self::FULL_TEXT] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return array
     */
    public function getFullText()
    {
        return $this->fullText;
    }

    /**
     * @module Search
     *
     * @param mixed $fullText
     *
     * @return $this
     */
    public function addFullText($fullText)
    {
        $this->fullText[] = $fullText;
        $this->modifiedProperties[self::FULL_TEXT] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFullText()
    {
        $this->assertPropertyIsSet(self::FULL_TEXT);

        return $this;
    }

    /**
     * @module Search
     *
     * @param array|null $fullTextBoosted
     *
     * @return $this
     */
    public function setFullTextBoosted(array $fullTextBoosted = null)
    {
        if ($fullTextBoosted === null) {
            $fullTextBoosted = [];
        }

        $this->fullTextBoosted = $fullTextBoosted;
        $this->modifiedProperties[self::FULL_TEXT_BOOSTED] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return array
     */
    public function getFullTextBoosted()
    {
        return $this->fullTextBoosted;
    }

    /**
     * @module Search
     *
     * @param mixed $fullTextBoosted
     *
     * @return $this
     */
    public function addFullTextBoosted($fullTextBoosted)
    {
        $this->fullTextBoosted[] = $fullTextBoosted;
        $this->modifiedProperties[self::FULL_TEXT_BOOSTED] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFullTextBoosted()
    {
        $this->assertPropertyIsSet(self::FULL_TEXT_BOOSTED);

        return $this;
    }

    /**
     * @module Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\StringFacetMapTransfer[] $stringFacet
     *
     * @return $this
     */
    public function setStringFacet(ArrayObject $stringFacet)
    {
        $this->stringFacet = $stringFacet;
        $this->modifiedProperties[self::STRING_FACET] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\StringFacetMapTransfer[]
     */
    public function getStringFacet()
    {
        return $this->stringFacet;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\StringFacetMapTransfer $stringFacet
     *
     * @return $this
     */
    public function addStringFacet(StringFacetMapTransfer $stringFacet)
    {
        $this->stringFacet[] = $stringFacet;
        $this->modifiedProperties[self::STRING_FACET] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireStringFacet()
    {
        $this->assertCollectionPropertyIsSet(self::STRING_FACET);

        return $this;
    }

    /**
     * @module Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\IntegerFacetMapTransfer[] $integerFacet
     *
     * @return $this
     */
    public function setIntegerFacet(ArrayObject $integerFacet)
    {
        $this->integerFacet = $integerFacet;
        $this->modifiedProperties[self::INTEGER_FACET] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\IntegerFacetMapTransfer[]
     */
    public function getIntegerFacet()
    {
        return $this->integerFacet;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\IntegerFacetMapTransfer $integerFacet
     *
     * @return $this
     */
    public function addIntegerFacet(IntegerFacetMapTransfer $integerFacet)
    {
        $this->integerFacet[] = $integerFacet;
        $this->modifiedProperties[self::INTEGER_FACET] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIntegerFacet()
    {
        $this->assertCollectionPropertyIsSet(self::INTEGER_FACET);

        return $this;
    }

    /**
     * @module Search
     *
     * @param array|null $completionTerms
     *
     * @return $this
     */
    public function setCompletionTerms(array $completionTerms = null)
    {
        if ($completionTerms === null) {
            $completionTerms = [];
        }

        $this->completionTerms = $completionTerms;
        $this->modifiedProperties[self::COMPLETION_TERMS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return array
     */
    public function getCompletionTerms()
    {
        return $this->completionTerms;
    }

    /**
     * @module Search
     *
     * @param mixed $completionTerms
     *
     * @return $this
     */
    public function addCompletionTerms($completionTerms)
    {
        $this->completionTerms[] = $completionTerms;
        $this->modifiedProperties[self::COMPLETION_TERMS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCompletionTerms()
    {
        $this->assertPropertyIsSet(self::COMPLETION_TERMS);

        return $this;
    }

    /**
     * @module Search
     *
     * @param array|null $suggestionTerms
     *
     * @return $this
     */
    public function setSuggestionTerms(array $suggestionTerms = null)
    {
        if ($suggestionTerms === null) {
            $suggestionTerms = [];
        }

        $this->suggestionTerms = $suggestionTerms;
        $this->modifiedProperties[self::SUGGESTION_TERMS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return array
     */
    public function getSuggestionTerms()
    {
        return $this->suggestionTerms;
    }

    /**
     * @module Search
     *
     * @param mixed $suggestionTerms
     *
     * @return $this
     */
    public function addSuggestionTerms($suggestionTerms)
    {
        $this->suggestionTerms[] = $suggestionTerms;
        $this->modifiedProperties[self::SUGGESTION_TERMS] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSuggestionTerms()
    {
        $this->assertPropertyIsSet(self::SUGGESTION_TERMS);

        return $this;
    }

    /**
     * @module Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\StringSortMapTransfer[] $stringSort
     *
     * @return $this
     */
    public function setStringSort(ArrayObject $stringSort)
    {
        $this->stringSort = $stringSort;
        $this->modifiedProperties[self::STRING_SORT] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\StringSortMapTransfer[]
     */
    public function getStringSort()
    {
        return $this->stringSort;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\StringSortMapTransfer $stringSort
     *
     * @return $this
     */
    public function addStringSort(StringSortMapTransfer $stringSort)
    {
        $this->stringSort[] = $stringSort;
        $this->modifiedProperties[self::STRING_SORT] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireStringSort()
    {
        $this->assertCollectionPropertyIsSet(self::STRING_SORT);

        return $this;
    }

    /**
     * @module Search
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\IntegerSortMapTransfer[] $integerSort
     *
     * @return $this
     */
    public function setIntegerSort(ArrayObject $integerSort)
    {
        $this->integerSort = $integerSort;
        $this->modifiedProperties[self::INTEGER_SORT] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\IntegerSortMapTransfer[]
     */
    public function getIntegerSort()
    {
        return $this->integerSort;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\IntegerSortMapTransfer $integerSort
     *
     * @return $this
     */
    public function addIntegerSort(IntegerSortMapTransfer $integerSort)
    {
        $this->integerSort[] = $integerSort;
        $this->modifiedProperties[self::INTEGER_SORT] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIntegerSort()
    {
        $this->assertCollectionPropertyIsSet(self::INTEGER_SORT);

        return $this;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\CategoryMapTransfer|null $category
     *
     * @return $this
     */
    public function setCategory(CategoryMapTransfer $category = null)
    {
        $this->category = $category;
        $this->modifiedProperties[self::CATEGORY] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return \Generated\Shared\Transfer\CategoryMapTransfer|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @module Search
     *
     * @param \Generated\Shared\Transfer\CategoryMapTransfer $category
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCategoryOrFail(CategoryMapTransfer $category)
    {
        return $this->setCategory($category);
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\CategoryMapTransfer
     */
    public function getCategoryOrFail()
    {
        if ($this->category === null) {
            $this->throwNullValueException(static::CATEGORY);
        }

        return $this->category;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCategory()
    {
        $this->assertPropertyIsSet(self::CATEGORY);

        return $this;
    }

    /**
     * @module Search
     *
     * @param bool|null $isActive
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
     * @module Search
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @module Search
     *
     * @param bool|null $isActive
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
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getIsActiveOrFail()
    {
        if ($this->isActive === null) {
            $this->throwNullValueException(static::IS_ACTIVE);
        }

        return $this->isActive;
    }

    /**
     * @module Search
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
     * @module Search
     *
     * @param string|null $activeFrom
     *
     * @return $this
     */
    public function setActiveFrom($activeFrom)
    {
        $this->activeFrom = $activeFrom;
        $this->modifiedProperties[self::ACTIVE_FROM] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return string|null
     */
    public function getActiveFrom()
    {
        return $this->activeFrom;
    }

    /**
     * @module Search
     *
     * @param string|null $activeFrom
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setActiveFromOrFail($activeFrom)
    {
        if ($activeFrom === null) {
            $this->throwNullValueException(static::ACTIVE_FROM);
        }

        return $this->setActiveFrom($activeFrom);
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getActiveFromOrFail()
    {
        if ($this->activeFrom === null) {
            $this->throwNullValueException(static::ACTIVE_FROM);
        }

        return $this->activeFrom;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireActiveFrom()
    {
        $this->assertPropertyIsSet(self::ACTIVE_FROM);

        return $this;
    }

    /**
     * @module Search
     *
     * @param string|null $activeTo
     *
     * @return $this
     */
    public function setActiveTo($activeTo)
    {
        $this->activeTo = $activeTo;
        $this->modifiedProperties[self::ACTIVE_TO] = true;

        return $this;
    }

    /**
     * @module Search
     *
     * @return string|null
     */
    public function getActiveTo()
    {
        return $this->activeTo;
    }

    /**
     * @module Search
     *
     * @param string|null $activeTo
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setActiveToOrFail($activeTo)
    {
        if ($activeTo === null) {
            $this->throwNullValueException(static::ACTIVE_TO);
        }

        return $this->setActiveTo($activeTo);
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getActiveToOrFail()
    {
        if ($this->activeTo === null) {
            $this->throwNullValueException(static::ACTIVE_TO);
        }

        return $this->activeTo;
    }

    /**
     * @module Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireActiveTo()
    {
        $this->assertPropertyIsSet(self::ACTIVE_TO);

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
                case 'type':
                case 'store':
                case 'locale':
                case 'fullText':
                case 'fullTextBoosted':
                case 'completionTerms':
                case 'suggestionTerms':
                case 'isActive':
                case 'activeFrom':
                case 'activeTo':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'category':
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
                case 'searchResultData':
                case 'stringFacet':
                case 'integerFacet':
                case 'stringSort':
                case 'integerSort':
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
                case 'type':
                case 'store':
                case 'locale':
                case 'fullText':
                case 'fullTextBoosted':
                case 'completionTerms':
                case 'suggestionTerms':
                case 'isActive':
                case 'activeFrom':
                case 'activeTo':
                    $values[$arrayKey] = $value;

                    break;
                case 'category':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

                    break;
                case 'searchResultData':
                case 'stringFacet':
                case 'integerFacet':
                case 'stringSort':
                case 'integerSort':
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
                case 'type':
                case 'store':
                case 'locale':
                case 'fullText':
                case 'fullTextBoosted':
                case 'completionTerms':
                case 'suggestionTerms':
                case 'isActive':
                case 'activeFrom':
                case 'activeTo':
                    $values[$arrayKey] = $value;

                    break;
                case 'category':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

                    break;
                case 'searchResultData':
                case 'stringFacet':
                case 'integerFacet':
                case 'stringSort':
                case 'integerSort':
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
        $this->searchResultData = $this->searchResultData ?: new ArrayObject();
        $this->stringFacet = $this->stringFacet ?: new ArrayObject();
        $this->integerFacet = $this->integerFacet ?: new ArrayObject();
        $this->stringSort = $this->stringSort ?: new ArrayObject();
        $this->integerSort = $this->integerSort ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'type' => $this->type,
            'store' => $this->store,
            'locale' => $this->locale,
            'fullText' => $this->fullText,
            'fullTextBoosted' => $this->fullTextBoosted,
            'completionTerms' => $this->completionTerms,
            'suggestionTerms' => $this->suggestionTerms,
            'isActive' => $this->isActive,
            'activeFrom' => $this->activeFrom,
            'activeTo' => $this->activeTo,
            'category' => $this->category,
            'searchResultData' => $this->searchResultData,
            'stringFacet' => $this->stringFacet,
            'integerFacet' => $this->integerFacet,
            'stringSort' => $this->stringSort,
            'integerSort' => $this->integerSort,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'type' => $this->type,
            'store' => $this->store,
            'locale' => $this->locale,
            'full_text' => $this->fullText,
            'full_text_boosted' => $this->fullTextBoosted,
            'completion_terms' => $this->completionTerms,
            'suggestion_terms' => $this->suggestionTerms,
            'is_active' => $this->isActive,
            'active_from' => $this->activeFrom,
            'active_to' => $this->activeTo,
            'category' => $this->category,
            'search_result_data' => $this->searchResultData,
            'string_facet' => $this->stringFacet,
            'integer_facet' => $this->integerFacet,
            'string_sort' => $this->stringSort,
            'integer_sort' => $this->integerSort,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'type' => $this->type instanceof AbstractTransfer ? $this->type->toArray(true, false) : $this->type,
            'store' => $this->store instanceof AbstractTransfer ? $this->store->toArray(true, false) : $this->store,
            'locale' => $this->locale instanceof AbstractTransfer ? $this->locale->toArray(true, false) : $this->locale,
            'full_text' => $this->fullText instanceof AbstractTransfer ? $this->fullText->toArray(true, false) : $this->fullText,
            'full_text_boosted' => $this->fullTextBoosted instanceof AbstractTransfer ? $this->fullTextBoosted->toArray(true, false) : $this->fullTextBoosted,
            'completion_terms' => $this->completionTerms instanceof AbstractTransfer ? $this->completionTerms->toArray(true, false) : $this->completionTerms,
            'suggestion_terms' => $this->suggestionTerms instanceof AbstractTransfer ? $this->suggestionTerms->toArray(true, false) : $this->suggestionTerms,
            'is_active' => $this->isActive instanceof AbstractTransfer ? $this->isActive->toArray(true, false) : $this->isActive,
            'active_from' => $this->activeFrom instanceof AbstractTransfer ? $this->activeFrom->toArray(true, false) : $this->activeFrom,
            'active_to' => $this->activeTo instanceof AbstractTransfer ? $this->activeTo->toArray(true, false) : $this->activeTo,
            'category' => $this->category instanceof AbstractTransfer ? $this->category->toArray(true, false) : $this->category,
            'search_result_data' => $this->searchResultData instanceof AbstractTransfer ? $this->searchResultData->toArray(true, false) : $this->addValuesToCollection($this->searchResultData, true, false),
            'string_facet' => $this->stringFacet instanceof AbstractTransfer ? $this->stringFacet->toArray(true, false) : $this->addValuesToCollection($this->stringFacet, true, false),
            'integer_facet' => $this->integerFacet instanceof AbstractTransfer ? $this->integerFacet->toArray(true, false) : $this->addValuesToCollection($this->integerFacet, true, false),
            'string_sort' => $this->stringSort instanceof AbstractTransfer ? $this->stringSort->toArray(true, false) : $this->addValuesToCollection($this->stringSort, true, false),
            'integer_sort' => $this->integerSort instanceof AbstractTransfer ? $this->integerSort->toArray(true, false) : $this->addValuesToCollection($this->integerSort, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'type' => $this->type instanceof AbstractTransfer ? $this->type->toArray(true, true) : $this->type,
            'store' => $this->store instanceof AbstractTransfer ? $this->store->toArray(true, true) : $this->store,
            'locale' => $this->locale instanceof AbstractTransfer ? $this->locale->toArray(true, true) : $this->locale,
            'fullText' => $this->fullText instanceof AbstractTransfer ? $this->fullText->toArray(true, true) : $this->fullText,
            'fullTextBoosted' => $this->fullTextBoosted instanceof AbstractTransfer ? $this->fullTextBoosted->toArray(true, true) : $this->fullTextBoosted,
            'completionTerms' => $this->completionTerms instanceof AbstractTransfer ? $this->completionTerms->toArray(true, true) : $this->completionTerms,
            'suggestionTerms' => $this->suggestionTerms instanceof AbstractTransfer ? $this->suggestionTerms->toArray(true, true) : $this->suggestionTerms,
            'isActive' => $this->isActive instanceof AbstractTransfer ? $this->isActive->toArray(true, true) : $this->isActive,
            'activeFrom' => $this->activeFrom instanceof AbstractTransfer ? $this->activeFrom->toArray(true, true) : $this->activeFrom,
            'activeTo' => $this->activeTo instanceof AbstractTransfer ? $this->activeTo->toArray(true, true) : $this->activeTo,
            'category' => $this->category instanceof AbstractTransfer ? $this->category->toArray(true, true) : $this->category,
            'searchResultData' => $this->searchResultData instanceof AbstractTransfer ? $this->searchResultData->toArray(true, true) : $this->addValuesToCollection($this->searchResultData, true, true),
            'stringFacet' => $this->stringFacet instanceof AbstractTransfer ? $this->stringFacet->toArray(true, true) : $this->addValuesToCollection($this->stringFacet, true, true),
            'integerFacet' => $this->integerFacet instanceof AbstractTransfer ? $this->integerFacet->toArray(true, true) : $this->addValuesToCollection($this->integerFacet, true, true),
            'stringSort' => $this->stringSort instanceof AbstractTransfer ? $this->stringSort->toArray(true, true) : $this->addValuesToCollection($this->stringSort, true, true),
            'integerSort' => $this->integerSort instanceof AbstractTransfer ? $this->integerSort->toArray(true, true) : $this->addValuesToCollection($this->integerSort, true, true),
        ];
    }
}
