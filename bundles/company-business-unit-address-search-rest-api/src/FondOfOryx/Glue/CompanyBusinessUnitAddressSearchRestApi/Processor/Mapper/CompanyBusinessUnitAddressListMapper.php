<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitAddressListMapper implements CompanyBusinessUnitAddressListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected $paginationMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected $requestParameterFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected $customerReferenceFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected $customerIdFilter;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface $customerIdFilter
     */
    public function __construct(
        PaginationMapperInterface $paginationMapper,
        RequestParameterFilterInterface $requestParameterFilter,
        CustomerReferenceFilterInterface $customerReferenceFilter,
        CustomerIdFilterInterface $customerIdFilter
    ) {
        $this->paginationMapper = $paginationMapper;
        $this->requestParameterFilter = $requestParameterFilter;
        $this->customerReferenceFilter = $customerReferenceFilter;
        $this->customerIdFilter = $customerIdFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyBusinessUnitAddressListTransfer
    {
        return (new CompanyBusinessUnitAddressListTransfer())
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest))
            ->setCompanyUuid($this->requestParameterFilter->getRequestParameter($restRequest, 'company-id'))
            ->setCompanyBusinessUnitUuid($this->requestParameterFilter->getRequestParameter($restRequest, 'company-business-unit-id'))
            ->setDefaultBilling($this->requestParameterFilter->getRequestParameter($restRequest, 'default-billing') !== null ?
                filter_var($this->requestParameterFilter->getRequestParameter($restRequest, 'default-billing'), FILTER_VALIDATE_BOOLEAN) : null)
            ->setDefaultShipping($this->requestParameterFilter->getRequestParameter($restRequest, 'default-shipping') !== null ?
                filter_var($this->requestParameterFilter->getRequestParameter($restRequest, 'default-shipping'), FILTER_VALIDATE_BOOLEAN) : null)
            ->setSort($this->requestParameterFilter->getRequestParameter($restRequest, 'sort'))
            ->setCustomerId($this->customerIdFilter->filterFromRestRequest($restRequest))
            ->setCustomerReference($this->customerReferenceFilter->filterFromRestRequest($restRequest));
    }
}
