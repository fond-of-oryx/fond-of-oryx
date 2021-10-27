<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchPaginationTransfer;

class RestCompanyBusinessUnitSearchPaginationMapper implements RestCompanyBusinessUnitSearchPaginationMapperInterface
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
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig $config
     */
    public function __construct(CompanyBusinessUnitSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchPaginationTransfer
     */
    public function fromCompanyBusinessUnitList(
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): RestCompanyBusinessUnitSearchPaginationTransfer {
        $restCompanyBusinessUnitSearchPaginationTransfer = new RestCompanyBusinessUnitSearchPaginationTransfer();

        $paginationTransfer = $companyBusinessUnitListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restCompanyBusinessUnitSearchPaginationTransfer;
        }

        return $restCompanyBusinessUnitSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestCompanyBusinessUnitSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchPaginationConfigTransfer
     */
    protected function createRestCompanyBusinessUnitSearchPaginationConfig(): RestCompanyBusinessUnitSearchPaginationConfigTransfer
    {
        return (new RestCompanyBusinessUnitSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
