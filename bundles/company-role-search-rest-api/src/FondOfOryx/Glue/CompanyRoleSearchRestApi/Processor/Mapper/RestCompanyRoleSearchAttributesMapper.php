<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;

class RestCompanyRoleSearchAttributesMapper implements RestCompanyRoleSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapperInterface
     */
    protected $restCompanyRoleSearchResultItemMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchSortMapperInterface
     */
    protected $restCompanyRoleSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapperInterface
     */
    protected $restCompanyRoleSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapperInterface $restCompanyRoleSearchResultItemMapper
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchSortMapperInterface $restCompanyRoleSearchSortMapper
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapperInterface $restCompanyRoleSearchPaginationMapper
     */
    public function __construct(
        RestCompanyRoleSearchResultItemMapperInterface $restCompanyRoleSearchResultItemMapper,
        RestCompanyRoleSearchSortMapperInterface $restCompanyRoleSearchSortMapper,
        RestCompanyRoleSearchPaginationMapperInterface $restCompanyRoleSearchPaginationMapper
    ) {
        $this->restCompanyRoleSearchResultItemMapper = $restCompanyRoleSearchResultItemMapper;
        $this->restCompanyRoleSearchSortMapper = $restCompanyRoleSearchSortMapper;
        $this->restCompanyRoleSearchPaginationMapper = $restCompanyRoleSearchPaginationMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer
     */
    public function fromCompanyRoleList(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): RestCompanyRoleSearchAttributesTransfer {
        return (new RestCompanyRoleSearchAttributesTransfer())->setCompanyRole(
            $this->restCompanyRoleSearchResultItemMapper->fromCompanyRoleList($companyRoleListTransfer),
        )->setSort(
            $this->restCompanyRoleSearchSortMapper->fromCompanyRoleList($companyRoleListTransfer),
        )->setPagination(
            $this->restCompanyRoleSearchPaginationMapper->fromCompanyRoleList($companyRoleListTransfer),
        );
    }
}
