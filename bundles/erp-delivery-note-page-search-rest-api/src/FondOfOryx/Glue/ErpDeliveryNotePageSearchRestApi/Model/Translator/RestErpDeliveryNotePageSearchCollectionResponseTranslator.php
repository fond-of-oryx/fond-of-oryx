<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;

class RestErpDeliveryNotePageSearchCollectionResponseTranslator implements RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(
        ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
    ) {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer $restErpDeliveryNotePageSearchCollectionResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer
     */
    public function translate(
        RestErpDeliveryNotePageSearchCollectionResponseTransfer $restErpDeliveryNotePageSearchCollectionResponseTransfer,
        string $locale
    ): RestErpDeliveryNotePageSearchCollectionResponseTransfer {
        $restErpDeliveryNotePageSearchPaginationSortTransfer = $restErpDeliveryNotePageSearchCollectionResponseTransfer->getSort();

        if ($restErpDeliveryNotePageSearchPaginationSortTransfer === null) {
            return $restErpDeliveryNotePageSearchCollectionResponseTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restErpDeliveryNotePageSearchPaginationSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restErpDeliveryNotePageSearchPaginationSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restErpDeliveryNotePageSearchCollectionResponseTransfer;
    }
}
