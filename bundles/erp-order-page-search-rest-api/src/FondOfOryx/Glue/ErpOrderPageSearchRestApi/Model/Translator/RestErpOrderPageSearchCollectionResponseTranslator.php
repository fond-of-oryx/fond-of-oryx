<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Translator;

use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

class RestErpOrderPageSearchCollectionResponseTranslator implements RestErpOrderPageSearchCollectionResponseTranslatorInterface
{
    /**
     * @var string
     */
    public const GLOSSARY_SORT_PARAM_NAME_KEY_PREFIX = 'erp_order_page_search_rest_api.sort.';

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(ErpOrderPageSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer $restErpOrderPageSearchCollectionResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer
     */
    public function translate(
        RestErpOrderPageSearchCollectionResponseTransfer $restErpOrderPageSearchCollectionResponseTransfer,
        string $locale
    ): RestErpOrderPageSearchCollectionResponseTransfer {
        $restErpOrderPageSearchPaginationSortTransfer = $restErpOrderPageSearchCollectionResponseTransfer->getSort();

        if ($restErpOrderPageSearchPaginationSortTransfer === null) {
            return $restErpOrderPageSearchCollectionResponseTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restErpOrderPageSearchPaginationSortTransfer->getSortParamNames() as $sortParamName) {
            $sortParamLocalizedNames[$sortParamName] = $this->glossaryStorageClient->translate(
                sprintf('%s%s', static::GLOSSARY_SORT_PARAM_NAME_KEY_PREFIX, $sortParamName),
                $locale,
            );
        }

        $restErpOrderPageSearchPaginationSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restErpOrderPageSearchCollectionResponseTransfer;
    }
}
