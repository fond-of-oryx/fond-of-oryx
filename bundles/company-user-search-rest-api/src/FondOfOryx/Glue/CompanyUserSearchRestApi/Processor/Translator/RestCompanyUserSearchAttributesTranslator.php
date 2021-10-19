<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator;

use FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;

class RestCompanyUserSearchAttributesTranslator implements RestCompanyUserSearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(CompanyUserSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer $restCompanyUserSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer
     */
    public function translate(
        RestCompanyUserSearchAttributesTransfer $restCompanyUserSearchAttributesTransfer,
        string $locale
    ): RestCompanyUserSearchAttributesTransfer {
        $restCompanyUserSearchSortTransfer = $restCompanyUserSearchAttributesTransfer->getSort();

        if ($restCompanyUserSearchSortTransfer === null) {
            return $restCompanyUserSearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restCompanyUserSearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale
            );
        }

        $restCompanyUserSearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restCompanyUserSearchAttributesTransfer;
    }
}
