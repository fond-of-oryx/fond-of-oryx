<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchPaginationTransfer;

class RestCompanyRoleSearchPaginationMapper implements RestCompanyRoleSearchPaginationMapperInterface
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
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig $config
     */
    public function __construct(CompanyRoleSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchPaginationTransfer
     */
    public function fromCompanyRoleList(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): RestCompanyRoleSearchPaginationTransfer {
        $restCompanyRoleSearchPaginationTransfer = new RestCompanyRoleSearchPaginationTransfer();

        $paginationTransfer = $companyRoleListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restCompanyRoleSearchPaginationTransfer;
        }

        return $restCompanyRoleSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestCompanyUserSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchPaginationConfigTransfer
     */
    protected function createRestCompanyUserSearchPaginationConfig(): RestCompanyRoleSearchPaginationConfigTransfer
    {
        return (new RestCompanyRoleSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
