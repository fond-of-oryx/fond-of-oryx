<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Translator;

use FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;

class RestCartSearchAttributesTranslator implements RestCartSearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(CartSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCartSearchAttributesTransfer $restCartSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCartSearchAttributesTransfer
     */
    public function translate(
        RestCartSearchAttributesTransfer $restCartSearchAttributesTransfer,
        string $locale
    ): RestCartSearchAttributesTransfer {
        $restCartSearchSortTransfer = $restCartSearchAttributesTransfer->getSort();

        if ($restCartSearchSortTransfer === null) {
            return $restCartSearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restCartSearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restCartSearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restCartSearchAttributesTransfer;
    }
}
