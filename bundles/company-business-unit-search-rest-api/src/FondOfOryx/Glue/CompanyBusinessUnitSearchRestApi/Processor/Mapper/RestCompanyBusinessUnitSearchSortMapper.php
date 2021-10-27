<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer;

class RestCompanyBusinessUnitSearchSortMapper implements RestCompanyBusinessUnitSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const SORT_PATTERN = '/([a-z_]*)_(asc|desc)/';

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
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer
     */
    public function fromCompanyBusinessUnitList(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): RestCompanyBusinessUnitSearchSortTransfer
    {
        $restCompanyBusinessUnitSearchSortTransfer = (new RestCompanyBusinessUnitSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = $companyBusinessUnitListTransfer->getSort();

        if ($sort === null) {
            return $restCompanyBusinessUnitSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::SORT_PATTERN, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCompanyBusinessUnitSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::SORT_PATTERN, '$2', $sort);

        return $restCompanyBusinessUnitSearchSortTransfer->setCurrentSortParam($sort)
            ->setCurrentSortOrder($sortDirection);
    }
}
