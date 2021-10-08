<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestCompanySearchPaginationTransfer;

class RestCompanySearchPaginationMapper implements RestCompanySearchPaginationMapperInterface
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
     * @var \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig $config
     */
    public function __construct(CompanySearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchPaginationTransfer
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): RestCompanySearchPaginationTransfer
    {
        $restCompanySearchPaginationTransfer = new RestCompanySearchPaginationTransfer();

        $paginationTransfer = $companyListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restCompanySearchPaginationTransfer;
        }

        return $restCompanySearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestCompanySearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanySearchPaginationConfigTransfer
     */
    protected function createRestCompanySearchPaginationConfig(): RestCompanySearchPaginationConfigTransfer
    {
        return (new RestCompanySearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
