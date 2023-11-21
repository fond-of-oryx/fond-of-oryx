<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\EmailFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserListMapper implements CompanyUserListMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected PaginationMapperInterface $paginationMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected RequestParameterFilterInterface $requestParameterFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected CustomerReferenceFilterInterface $customerReferenceFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected CustomerIdFilterInterface $customerIdFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface
     */
    protected CompanyRoleNameFilterInterface $companyRoleNameFilter;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected FilterFieldsMapperInterface $filterFieldsMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\EmailFilterInterface
     */
    protected EmailFilterInterface $emailFilter;

    /**
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface $paginationMapper
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface $filterFieldsMapper
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface $requestParameterFilter
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface $customerIdFilter
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface $companyRoleNameFilter
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\EmailFilterInterface $emailFilter
     */
    public function __construct(
        PaginationMapperInterface $paginationMapper,
        FilterFieldsMapperInterface $filterFieldsMapper,
        RequestParameterFilterInterface $requestParameterFilter,
        CustomerReferenceFilterInterface $customerReferenceFilter,
        CustomerIdFilterInterface $customerIdFilter,
        CompanyRoleNameFilterInterface $companyRoleNameFilter,
        EmailFilterInterface $emailFilter
    ) {
        $this->paginationMapper = $paginationMapper;
        $this->filterFieldsMapper = $filterFieldsMapper;
        $this->requestParameterFilter = $requestParameterFilter;
        $this->customerReferenceFilter = $customerReferenceFilter;
        $this->customerIdFilter = $customerIdFilter;
        $this->companyRoleNameFilter = $companyRoleNameFilter;
        $this->emailFilter = $emailFilter;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function fromRestRequest(RestRequestInterface $restRequest): CompanyUserListTransfer
    {
        return (new CompanyUserListTransfer())
            ->setPagination($this->paginationMapper->fromRestRequest($restRequest))
            ->setFilterFields($this->filterFieldsMapper->fromRestRequest($restRequest))
            ->setShowAll($this->requestParameterFilter->getRequestParameter($restRequest, 'show-all') === 'true')
            ->setOnlyOnePerCustomer($this->requestParameterFilter->getRequestParameter($restRequest, 'only-one-per-customer') === 'true')
            ->setCompanyUuid($this->requestParameterFilter->getRequestParameter($restRequest, 'company-id'))
            ->setCompanyUserReference($this->requestParameterFilter->getRequestParameter($restRequest, 'company-user-reference'))
            ->setCustomerId($this->customerIdFilter->filterFromRestRequest($restRequest))
            ->setCustomerReference($this->customerReferenceFilter->filterFromRestRequest($restRequest))
            ->setCompanyRoleNames($this->companyRoleNameFilter->filterFromRestRequest($restRequest))
            ->setEmails($this->emailFilter->filterFromRestRequest($restRequest));
    }
}
