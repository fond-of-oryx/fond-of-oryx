<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Translator;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;

class RestCompanyRoleSearchAttributesTranslator implements RestCompanyRoleSearchAttributesTranslatorInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient
     */
    public function __construct(CompanyRoleSearchRestApiToGlossaryStorageClientInterface $glossaryStorageClient)
    {
        $this->glossaryStorageClient = $glossaryStorageClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer $restCompanyRoleSearchAttributesTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer
     */
    public function translate(
        RestCompanyRoleSearchAttributesTransfer $restCompanyRoleSearchAttributesTransfer,
        string $locale
    ): RestCompanyRoleSearchAttributesTransfer {
        $restCompanyRoleSearchSortTransfer = $restCompanyRoleSearchAttributesTransfer->getSort();

        if ($restCompanyRoleSearchSortTransfer === null) {
            return $restCompanyRoleSearchAttributesTransfer;
        }

        $sortParamLocalizedNames = [];

        foreach ($restCompanyRoleSearchSortTransfer->getSortParamLocalizedNames() as $sortParamNames => $sortParamLocalizedName) {
            $sortParamLocalizedNames[$sortParamNames] = $this->glossaryStorageClient->translate(
                $sortParamLocalizedName,
                $locale,
            );
        }

        $restCompanyRoleSearchSortTransfer->setSortParamLocalizedNames($sortParamLocalizedNames);

        return $restCompanyRoleSearchAttributesTransfer;
    }
}
