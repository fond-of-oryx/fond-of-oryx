<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;

class RestErpInvoicePageSearchCollectionResponseTranslator implements RestErpInvoicePageSearchCollectionResponseTranslatorInterface
{
    /**
     * @var string
     */
    public const GLOSSARY_SORT_PARAM_NAME_KEY_PREFIX = 'erp_invoice_page_search_rest_api.sort.';

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer $restErpInvoicePageSearchCollectionResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer
     */
    public function translate(
        RestErpInvoicePageSearchCollectionResponseTransfer $restErpInvoicePageSearchCollectionResponseTransfer,
        string $locale
    ): RestErpInvoicePageSearchCollectionResponseTransfer {
        $restErpInvoicePageSearchPaginationSortTransfer = $restErpInvoicePageSearchCollectionResponseTransfer->getSort();

        if ($restErpInvoicePageSearchPaginationSortTransfer === null) {
            return $restErpInvoicePageSearchCollectionResponseTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restErpInvoicePageSearchPaginationSortTransfer->getSortParamNames() as $sortParamName) {
            $sortParamLocalizedNames[$sortParamName] = $this->glossaryStorageClient->translate(
                sprintf('%s%s', static::GLOSSARY_SORT_PARAM_NAME_KEY_PREFIX, $sortParamName),
                $locale,
            );
        }

        $restErpInvoicePageSearchPaginationSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restErpInvoicePageSearchCollectionResponseTransfer;
    }
}
