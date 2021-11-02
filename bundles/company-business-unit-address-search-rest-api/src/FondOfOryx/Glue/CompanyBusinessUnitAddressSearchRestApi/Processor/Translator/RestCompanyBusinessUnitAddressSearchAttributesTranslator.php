<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;

class RestCompanyBusinessUnitAddressSearchAttributesTranslator implements RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer $restCompanyBusinessUnitAddressSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer
     */
    public function translate(
        RestCompanyBusinessUnitAddressSearchAttributesTransfer $restCompanyBusinessUnitAddressSearchAttributesTransfer,
        string $locale
    ): RestCompanyBusinessUnitAddressSearchAttributesTransfer {
        $restCompanyBusinessUnitAddressSearchSortTransfer = $restCompanyBusinessUnitAddressSearchAttributesTransfer->getSort();

        if ($restCompanyBusinessUnitAddressSearchSortTransfer === null) {
            return $restCompanyBusinessUnitAddressSearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restCompanyBusinessUnitAddressSearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restCompanyBusinessUnitAddressSearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restCompanyBusinessUnitAddressSearchAttributesTransfer;
    }
}
