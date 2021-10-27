<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitListMapper implements CompanyBusinessUnitListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected $paginationMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected $requestParameterFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected $customerReferenceFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected $customerIdFilter;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Filter\CustomerIdFilterInterface $customerIdFilter
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
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyBusinessUnitListTransfer
    {
        return (new CompanyBusinessUnitListTransfer())
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest))
            ->setCompanyUuid($this->requestParameterFilter->getRequestParameter($restRequest, 'company-id'))
            ->setSort($this->requestParameterFilter->getRequestParameter($restRequest, 'sort'))
            ->setCustomerId($this->customerIdFilter->filterFromRestRequest($restRequest))
            ->setCustomerReference($this->customerReferenceFilter->filterFromRestRequest($restRequest));
    }
}
