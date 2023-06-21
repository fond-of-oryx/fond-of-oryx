<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer;

class RestCompanyUserSearchSortMapper implements RestCompanyUserSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const PATTERN_ORDER_BY = '/^([a-z_]+)::(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig
     */
    protected CompanyUserSearchRestApiConfig $config;

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

        $sort = null;

        foreach ($companyUserListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== 'orderBy') {
                continue;
            }

            $sort = $filterFieldTransfer->getValue();
        }

        if ($sort === null) {
            return $restCompanyUserSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::PATTERN_ORDER_BY, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCompanyUserSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::PATTERN_ORDER_BY, '$2', $sort);

        return $restCompanyUserSearchSortTransfer->setCurrentSortParam(sprintf('%s%s%s', $sortField, CompanyUserSearchRestApiConstants::DELIMITER_SORT, $sortDirection))
            ->setCurrentSortOrder($sortDirection);
    }
}
