<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationTransfer;

class RestCompanyBusinessUnitAddressSearchPaginationMapper implements RestCompanyBusinessUnitAddressSearchPaginationMapperInterface
{
    /**
     * @var string
     */
    public const PARAMETER_NAME_PAGE = 'page';

    /**
     * @var string
     */
    public const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig $config
     */
    public function __construct(CompanyBusinessUnitAddressSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationTransfer
     */
    public function fromCompanyBusinessUnitAddressList(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchPaginationTransfer {
        $restCompanyBusinessUnitAddressSearchPaginationTransfer = new RestCompanyBusinessUnitAddressSearchPaginationTransfer();

        $paginationTransfer = $companyBusinessUnitAddressListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restCompanyBusinessUnitAddressSearchPaginationTransfer;
        }

        return $restCompanyBusinessUnitAddressSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestCompanyBusinessUnitAddressSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationConfigTransfer
     */
    protected function createRestCompanyBusinessUnitAddressSearchPaginationConfig(): RestCompanyBusinessUnitAddressSearchPaginationConfigTransfer
    {
        return (new RestCompanyBusinessUnitAddressSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
