<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer;

class RestCompanyRoleSearchSortMapper implements RestCompanyRoleSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const SORT_PATTERN = '/([a-z_]*)_(asc|desc)/';

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
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer
     */
    public function fromCompanyRoleList(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): RestCompanyRoleSearchSortTransfer {
        $restCompanyRoleSearchSortTransfer = (new RestCompanyRoleSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = $companyRoleListTransfer->getSort();

        if ($sort === null) {
            return $restCompanyRoleSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::SORT_PATTERN, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCompanyRoleSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::SORT_PATTERN, '$2', $sort);

        return $restCompanyRoleSearchSortTransfer->setCurrentSortParam($sort)
            ->setCurrentSortOrder($sortDirection);
    }
}
