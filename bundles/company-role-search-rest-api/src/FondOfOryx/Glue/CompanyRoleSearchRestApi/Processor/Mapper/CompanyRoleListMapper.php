<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyRoleListMapper implements CompanyRoleListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected $paginationMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected $requestParameterFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected $customerReferenceFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected $customerIdFilter;

    /**
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface $customerIdFilter
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
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyRoleListTransfer
    {
        return (new CompanyRoleListTransfer())
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest))
            ->setQuery($this->requestParameterFilter->getRequestParameter($restRequest, 'q'))
            ->setShowAll($this->requestParameterFilter->getRequestParameter($restRequest, 'show-all') === 'true')
            ->setOnlyOnePerName($this->requestParameterFilter->getRequestParameter($restRequest, 'only-one-per-name') === 'true')
            ->setCompanyUuid($this->requestParameterFilter->getRequestParameter($restRequest, 'company-id'))
            ->setSort($this->requestParameterFilter->getRequestParameter($restRequest, 'sort'))
            ->setCustomerId($this->customerIdFilter->filterFromRestRequest($restRequest))
            ->setCustomerReference($this->customerReferenceFilter->filterFromRestRequest($restRequest));
    }
}
