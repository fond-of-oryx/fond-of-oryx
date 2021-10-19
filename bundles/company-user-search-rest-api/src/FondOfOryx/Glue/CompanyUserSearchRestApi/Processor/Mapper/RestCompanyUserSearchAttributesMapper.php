<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;

class RestCompanyUserSearchAttributesMapper implements RestCompanyUserSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapperInterface
     */
    protected $restCompanyUserSearchResultItemMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapperInterface
     */
    protected $restCompanyUserSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapperInterface
     */
    protected $restCompanyUserSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapperInterface $restCompanyUserSearchResultItemMapper
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapperInterface $restCompanyUserSearchSortMapper
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapperInterface $restCompanyUserSearchPaginationMapper
     */
    public function __construct(
        RestCompanyUserSearchResultItemMapperInterface $restCompanyUserSearchResultItemMapper,
        RestCompanyUserSearchSortMapperInterface $restCompanyUserSearchSortMapper,
        RestCompanyUserSearchPaginationMapperInterface $restCompanyUserSearchPaginationMapper
    ) {
        $this->restCompanyUserSearchResultItemMapper = $restCompanyUserSearchResultItemMapper;
        $this->restCompanyUserSearchSortMapper = $restCompanyUserSearchSortMapper;
        $this->restCompanyUserSearchPaginationMapper = $restCompanyUserSearchPaginationMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): RestCompanyUserSearchAttributesTransfer
    {
        return (new RestCompanyUserSearchAttributesTransfer())->setCompanyUser(
            $this->restCompanyUserSearchResultItemMapper->fromCompanyUserList($companyUserListTransfer)
        )->setSort(
            $this->restCompanyUserSearchSortMapper->fromCompanyUserList($companyUserListTransfer)
        )->setPagination(
            $this->restCompanyUserSearchPaginationMapper->fromCompanyUserList($companyUserListTransfer)
        );
    }
}
