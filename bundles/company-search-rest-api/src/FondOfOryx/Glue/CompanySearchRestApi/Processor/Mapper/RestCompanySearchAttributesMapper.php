<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;

class RestCompanySearchAttributesMapper implements RestCompanySearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapperInterface
     */
    protected $restCompanySearchResultItemMapper;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapperInterface
     */
    protected $restCompanySearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchPaginationMapperInterface
     */
    protected $restCompanySearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapperInterface $restCompanySearchResultItemMapper
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapperInterface $restCompanySearchSortMapper
     * @param \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchPaginationMapperInterface $restCompanySearchPaginationMapper
     */
    public function __construct(
        RestCompanySearchResultItemMapperInterface $restCompanySearchResultItemMapper,
        RestCompanySearchSortMapperInterface $restCompanySearchSortMapper,
        RestCompanySearchPaginationMapperInterface $restCompanySearchPaginationMapper
    ) {
        $this->restCompanySearchResultItemMapper = $restCompanySearchResultItemMapper;
        $this->restCompanySearchSortMapper = $restCompanySearchSortMapper;
        $this->restCompanySearchPaginationMapper = $restCompanySearchPaginationMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): RestCompanySearchAttributesTransfer
    {
        return (new RestCompanySearchAttributesTransfer())->setCompanies(
            $this->restCompanySearchResultItemMapper->fromCompanyList($companyListTransfer),
        )->setSort(
            $this->restCompanySearchSortMapper->fromCompanyList($companyListTransfer),
        )->setPagination(
            $this->restCompanySearchPaginationMapper->fromCompanyList($companyListTransfer),
        );
    }
}
