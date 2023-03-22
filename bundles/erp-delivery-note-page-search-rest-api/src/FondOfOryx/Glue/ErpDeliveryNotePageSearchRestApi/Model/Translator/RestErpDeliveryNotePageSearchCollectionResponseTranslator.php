<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Translator;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;

class RestErpDeliveryNotePageSearchCollectionResponseTranslator implements RestErpDeliveryNotePageSearchCollectionResponseTranslatorInterface
{
    /**
     * @var string
     */
    public const GLOSSARY_SORT_PARAM_NAME_KEY_PREFIX = 'erp_delivery_note_page_search_rest_api.sort.';

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

        foreach ($restErpDeliveryNotePageSearchPaginationSortTransfer->getSortParamNames() as $sortParamName) {
            $sortParamLocalizedNames[$sortParamName] = $this->glossaryStorageClient->translate(
                sprintf('%s%s', static::GLOSSARY_SORT_PARAM_NAME_KEY_PREFIX, $sortParamName),
                $locale,
            );
        }

        $restErpDeliveryNotePageSearchPaginationSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restErpDeliveryNotePageSearchCollectionResponseTransfer;
    }
}
