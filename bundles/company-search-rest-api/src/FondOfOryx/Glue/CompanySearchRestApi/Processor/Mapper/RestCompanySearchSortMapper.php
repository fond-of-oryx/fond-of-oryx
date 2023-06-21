<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchSortTransfer;

class RestCompanySearchSortMapper implements RestCompanySearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const PATTERN_ORDER_BY = '/^([a-z_]+)::(asc|desc)/';

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig
     */
    protected CompanySearchRestApiConfig $config;

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
     * @return \Generated\Shared\Transfer\RestCompanySearchSortTransfer
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): RestCompanySearchSortTransfer
    {
        $restCompanySearchSortTransfer = (new RestCompanySearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = null;

        foreach ($companyListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== 'orderBy') {
                continue;
            }

            $sort = $filterFieldTransfer->getValue();
        }

        if ($sort === null) {
            return $restCompanySearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::PATTERN_ORDER_BY, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCompanySearchSortTransfer;
        }

        $sortDirection = preg_replace(static::PATTERN_ORDER_BY, '$2', $sort);

        return $restCompanySearchSortTransfer->setCurrentSortOrder($sortDirection)
            ->setCurrentSortParam(
                sprintf('%s%s%s', $sortField, CompanySearchRestApiConstants::DELIMITER_SORT, $sortDirection),
            );
    }
}
