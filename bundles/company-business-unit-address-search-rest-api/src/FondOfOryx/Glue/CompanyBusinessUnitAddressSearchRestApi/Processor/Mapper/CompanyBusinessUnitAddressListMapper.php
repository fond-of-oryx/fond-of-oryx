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
            ->setFilterFields($this->requestParameterFilter->getRequestParameter($restRequest))
            ->setCustomerId($this->customerIdFilter->filterFromRestRequest($restRequest))
            ->setCustomerReference($this->customerReferenceFilter->filterFromRestRequest($restRequest));
    }
}
