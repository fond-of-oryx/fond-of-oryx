<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer;

class RestCompanyUserSearchSortMapper implements RestCompanyUserSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const SORT_PATTERN = '/([a-z_]*)_(asc|desc)/';

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
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): RestCompanyUserSearchSortTransfer
    {
        $restCompanyUserSearchSortTransfer = (new RestCompanyUserSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = $companyUserListTransfer->getSort();

        if ($sort === null) {
            return $restCompanyUserSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::SORT_PATTERN, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCompanyUserSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::SORT_PATTERN, '$2', $sort);

        return $restCompanyUserSearchSortTransfer->setCurrentSortParam($sort)
            ->setCurrentSortOrder($sortDirection);
    }
}
