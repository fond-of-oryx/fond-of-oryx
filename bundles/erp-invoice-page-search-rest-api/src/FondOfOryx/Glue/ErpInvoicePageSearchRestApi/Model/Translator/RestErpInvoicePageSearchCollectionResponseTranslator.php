<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Translator;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;

class RestErpInvoicePageSearchCollectionResponseTranslator implements RestErpInvoicePageSearchCollectionResponseTranslatorInterface
{
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

        foreach ($restErpInvoicePageSearchPaginationSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restErpInvoicePageSearchPaginationSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restErpInvoicePageSearchCollectionResponseTransfer;
    }
}
