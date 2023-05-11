<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;

class RestOrderBudgetSearchAttributesTranslator implements RestOrderBudgetSearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface
     */
    protected OrderBudgetSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(OrderBudgetSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer $restOrderBudgetSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer
     */
    public function translate(
        RestOrderBudgetSearchAttributesTransfer $restOrderBudgetSearchAttributesTransfer,
        string $locale
    ): RestOrderBudgetSearchAttributesTransfer {
        $restOrderBudgetSearchSortTransfer = $restOrderBudgetSearchAttributesTransfer->getSort();

        if ($restOrderBudgetSearchSortTransfer === null) {
            return $restOrderBudgetSearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restOrderBudgetSearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restOrderBudgetSearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restOrderBudgetSearchAttributesTransfer;
    }
}
