<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Generated\Shared\Search;

use Spryker\Shared\Search\AbstractIndexMap;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF SEARCH MAP GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class PageIndexMap extends AbstractIndexMap
{

    const SEARCH_RESULT_DATA = 'search-result-data';
    const TYPE = 'type';
    const STORE = 'store';
    const IS_ACTIVE = 'is-active';
    const ACTIVE_FROM = 'active-from';
    const ACTIVE_TO = 'active-to';
    const LOCALE = 'locale';
    const FULL_TEXT = 'full-text';
    const FULL_TEXT_BOOSTED = 'full-text-boosted';
    const STRING_FACET = 'string-facet';
    const STRING_FACET_FACET_NAME = 'string-facet.facet-name';
    const STRING_FACET_FACET_VALUE = 'string-facet.facet-value';
    const INTEGER_FACET = 'integer-facet';
    const INTEGER_FACET_FACET_NAME = 'integer-facet.facet-name';
    const INTEGER_FACET_FACET_VALUE = 'integer-facet.facet-value';
    const COMPLETION_TERMS = 'completion-terms';
    const SUGGESTION_TERMS = 'suggestion-terms';
    const STRING_SORT = 'string-sort';
    const INTEGER_SORT = 'integer-sort';
    const CATEGORY = 'category';
    const CATEGORY_DIRECT_PARENTS = 'category.direct-parents';
    const CATEGORY_ALL_PARENTS = 'category.all-parents';

    /**
     * @var array
     */
    protected $metadata = [
        self::SEARCH_RESULT_DATA => [
            'type' => 'object',
        ],
        self::TYPE => [
            'type' => 'keyword',
        ],
        self::STORE => [
            'type' => 'keyword',
        ],
        self::IS_ACTIVE => [
            'type' => 'boolean',
        ],
        self::ACTIVE_FROM => [
            'type' => 'date',
        ],
        self::ACTIVE_TO => [
            'type' => 'date',
        ],
        self::LOCALE => [
            'type' => 'keyword',
        ],
        self::FULL_TEXT => [
            'type' => 'text',
        ],
        self::FULL_TEXT_BOOSTED => [
            'type' => 'text',
        ],
        self::STRING_FACET => [
            'type' => 'nested',
        ],
        self::STRING_FACET_FACET_NAME => [
            'type' => 'keyword',
        ],
        self::STRING_FACET_FACET_VALUE => [
            'type' => 'keyword',
        ],
        self::INTEGER_FACET => [
            'type' => 'nested',
        ],
        self::INTEGER_FACET_FACET_NAME => [
            'type' => 'keyword',
        ],
        self::INTEGER_FACET_FACET_VALUE => [
            'type' => 'integer',
        ],
        self::COMPLETION_TERMS => [
            'type' => 'keyword',
            'normalizer' => 'lowercase_normalizer',
        ],
        self::SUGGESTION_TERMS => [
            'type' => 'text',
            'analyzer' => 'suggestion_analyzer',
        ],
        self::STRING_SORT => [
            'type' => 'object',
        ],
        self::INTEGER_SORT => [
            'type' => 'object',
        ],
        self::CATEGORY => [
            'type' => 'object',
        ],
        self::CATEGORY_DIRECT_PARENTS => [
            'type' => 'integer',
        ],
        self::CATEGORY_ALL_PARENTS => [
            'type' => 'integer',
        ],
    ];

}
