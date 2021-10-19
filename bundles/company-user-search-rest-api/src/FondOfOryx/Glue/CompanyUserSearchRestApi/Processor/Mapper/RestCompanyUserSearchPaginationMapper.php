<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer;

class RestCompanyUserSearchPaginationMapper implements RestCompanyUserSearchPaginationMapperInterface
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
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig $config
     */
    public function __construct(CompanyUserSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): RestCompanyUserSearchPaginationTransfer
    {
        $restCompanyUserSearchPaginationTransfer = new RestCompanyUserSearchPaginationTransfer();

        $paginationTransfer = $companyUserListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restCompanyUserSearchPaginationTransfer;
        }

        return $restCompanyUserSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestCompanyUserSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchPaginationConfigTransfer
     */
    protected function createRestCompanyUserSearchPaginationConfig(): RestCompanyUserSearchPaginationConfigTransfer
    {
        return (new RestCompanyUserSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
