<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class RestProductListUpdateRequestExpander implements RestProductListUpdateRequestExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected $companyUserReader;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface
     */
    protected $customerReader;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface
     */
    protected $companyReader;

    /**
     * @param \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface $companyUserReader
     * @param \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface $customerReader
     * @param \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface $companyReader
     */
    public function __construct(
        CompanyUserReaderInterface $companyUserReader,
        CustomerReaderInterface $customerReader,
        CompanyReaderInterface $companyReader
    ) {
        $this->companyUserReader = $companyUserReader;
        $this->customerReader = $customerReader;
        $this->companyReader = $companyReader;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function expand(RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer): RestProductListUpdateRequestTransfer
    {
        $restProductListsAttributesTransfer = $restProductListUpdateRequestTransfer->getProductList();

        if ($restProductListsAttributesTransfer === null) {
            return $restProductListUpdateRequestTransfer;
        }

        $authorizedCompanyUserIds = $this->companyUserReader->getAuthorizedIdsByRestProductListUpdateRequest($restProductListUpdateRequestTransfer);
        $customerReferences = $this->customerReader->getWhitelistedReferencesByCompanyUserIds($authorizedCompanyUserIds);
        $companyUuids = $this->companyReader->getWhitelistedUuidsByCompanyUserIds($authorizedCompanyUserIds);

        $restProductListsAttributesTransfer->setCompanyIdsToAssign(
            array_intersect(
                $restProductListsAttributesTransfer->getCompanyIdsToAssign(),
                $companyUuids,
            ),
        )->setCompanyIdsToDeassign(
            array_intersect(
                $restProductListsAttributesTransfer->getCompanyIdsToDeassign(),
                $companyUuids,
            ),
        )->setCustomerIdsToAssign(
            array_intersect(
                $restProductListsAttributesTransfer->getCustomerIdsToAssign(),
                $customerReferences,
            ),
        )->setCustomerIdsToDeassign(
            array_intersect(
                $restProductListsAttributesTransfer->getCustomerIdsToDeassign(),
                $customerReferences,
            ),
        );

        return $restProductListUpdateRequestTransfer;
    }
}
