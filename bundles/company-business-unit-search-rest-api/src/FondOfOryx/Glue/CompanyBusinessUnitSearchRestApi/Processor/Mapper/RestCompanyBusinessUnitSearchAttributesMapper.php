<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;

class RestCompanyBusinessUnitSearchAttributesMapper implements RestCompanyBusinessUnitSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchResultItemMapperInterface
     */
    protected $restCompanyBusinessUnitSearchResultItemMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchSortMapperInterface
     */
    protected $restCompanyBusinessUnitSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchPaginationMapperInterface
     */
    protected $restCompanyBusinessUnitSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchResultItemMapperInterface $restCompanyBusinessUnitSearchResultItemMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchSortMapperInterface $restCompanyBusinessUnitSearchSortMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchPaginationMapperInterface $restCompanyBusinessUnitSearchPaginationMapper
     */
    public function __construct(
        RestCompanyBusinessUnitSearchResultItemMapperInterface $restCompanyBusinessUnitSearchResultItemMapper,
        RestCompanyBusinessUnitSearchSortMapperInterface $restCompanyBusinessUnitSearchSortMapper,
        RestCompanyBusinessUnitSearchPaginationMapperInterface $restCompanyBusinessUnitSearchPaginationMapper
    ) {
        $this->restCompanyBusinessUnitSearchResultItemMapper = $restCompanyBusinessUnitSearchResultItemMapper;
        $this->restCompanyBusinessUnitSearchSortMapper = $restCompanyBusinessUnitSearchSortMapper;
        $this->restCompanyBusinessUnitSearchPaginationMapper = $restCompanyBusinessUnitSearchPaginationMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer
     */
    public function fromCompanyBusinessUnitList(
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): RestCompanyBusinessUnitSearchAttributesTransfer {
        return (new RestCompanyBusinessUnitSearchAttributesTransfer())->setCompanyBusinessUnits(
            $this->restCompanyBusinessUnitSearchResultItemMapper->fromCompanyBusinessUnitList($companyBusinessUnitListTransfer)
        )->setSort(
            $this->restCompanyBusinessUnitSearchSortMapper->fromCompanyBusinessUnitList($companyBusinessUnitListTransfer)
        )->setPagination(
            $this->restCompanyBusinessUnitSearchPaginationMapper->fromCompanyBusinessUnitList($companyBusinessUnitListTransfer)
        );
    }
}
