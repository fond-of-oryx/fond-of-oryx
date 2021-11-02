<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator;

use FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;

class RestCompanySearchAttributesTranslator implements RestCompanySearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(CompanySearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer $restCompanySearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer
     */
    public function translate(
        RestCompanySearchAttributesTransfer $restCompanySearchAttributesTransfer,
        string $locale
    ): RestCompanySearchAttributesTransfer {
        $restCompanySearchSortTransfer = $restCompanySearchAttributesTransfer->getSort();

        if ($restCompanySearchSortTransfer === null) {
            return $restCompanySearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restCompanySearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restCompanySearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restCompanySearchAttributesTransfer;
    }
}
