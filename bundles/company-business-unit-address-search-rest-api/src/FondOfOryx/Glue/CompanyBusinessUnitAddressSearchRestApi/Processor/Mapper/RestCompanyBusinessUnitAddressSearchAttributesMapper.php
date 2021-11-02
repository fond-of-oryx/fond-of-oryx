<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;

class RestCompanyBusinessUnitAddressSearchAttributesMapper implements RestCompanyBusinessUnitAddressSearchAttributesMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapperInterface
     */
    protected $restCompanyBusinessUnitAddressSearchResultItemMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapperInterface
     */
    protected $restCompanyBusinessUnitAddressSearchSortMapper;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapperInterface
     */
    protected $restCompanyBusinessUnitAddressSearchPaginationMapper;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapperInterface $restCompanyBusinessUnitAddressSearchResultItemMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapperInterface $restCompanyBusinessUnitAddressSearchSortMapper
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapperInterface $restCompanyBusinessUnitAddressSearchPaginationMapper
     */
    public function __construct(
        RestCompanyBusinessUnitAddressSearchResultItemMapperInterface $restCompanyBusinessUnitAddressSearchResultItemMapper,
        RestCompanyBusinessUnitAddressSearchSortMapperInterface $restCompanyBusinessUnitAddressSearchSortMapper,
        RestCompanyBusinessUnitAddressSearchPaginationMapperInterface $restCompanyBusinessUnitAddressSearchPaginationMapper
    ) {
        $this->restCompanyBusinessUnitAddressSearchResultItemMapper = $restCompanyBusinessUnitAddressSearchResultItemMapper;
        $this->restCompanyBusinessUnitAddressSearchSortMapper = $restCompanyBusinessUnitAddressSearchSortMapper;
        $this->restCompanyBusinessUnitAddressSearchPaginationMapper = $restCompanyBusinessUnitAddressSearchPaginationMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer
     */
    public function fromCompanyBusinessUnitAddressList(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchAttributesTransfer {
        return (new RestCompanyBusinessUnitAddressSearchAttributesTransfer())->setCompanyBusinessUnitAddresses(
            $this->restCompanyBusinessUnitAddressSearchResultItemMapper->fromCompanyBusinessUnitAddressList($companyBusinessUnitAddressListTransfer),
        )->setSort(
            $this->restCompanyBusinessUnitAddressSearchSortMapper->fromCompanyBusinessUnitAddressList($companyBusinessUnitAddressListTransfer),
        )->setPagination(
            $this->restCompanyBusinessUnitAddressSearchPaginationMapper->fromCompanyBusinessUnitAddressList($companyBusinessUnitAddressListTransfer),
        );
    }
}
