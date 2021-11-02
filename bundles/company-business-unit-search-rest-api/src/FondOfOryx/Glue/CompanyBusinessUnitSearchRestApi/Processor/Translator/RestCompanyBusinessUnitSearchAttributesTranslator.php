<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Translator;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;

class RestCompanyBusinessUnitSearchAttributesTranslator implements RestCompanyBusinessUnitSearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(CompanyBusinessUnitSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer $restCompanyBusinessUnitSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer
     */
    public function translate(
        RestCompanyBusinessUnitSearchAttributesTransfer $restCompanyBusinessUnitSearchAttributesTransfer,
        string $locale
    ): RestCompanyBusinessUnitSearchAttributesTransfer {
        $restCompanyBusinessUnitSearchSortTransfer = $restCompanyBusinessUnitSearchAttributesTransfer->getSort();

        if ($restCompanyBusinessUnitSearchSortTransfer === null) {
            return $restCompanyBusinessUnitSearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restCompanyBusinessUnitSearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restCompanyBusinessUnitSearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restCompanyBusinessUnitSearchAttributesTransfer;
    }
}
