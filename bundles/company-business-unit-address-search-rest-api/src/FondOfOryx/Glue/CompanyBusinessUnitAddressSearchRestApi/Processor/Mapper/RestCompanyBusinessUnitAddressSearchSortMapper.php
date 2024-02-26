<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer;

class RestCompanyBusinessUnitAddressSearchSortMapper implements RestCompanyBusinessUnitAddressSearchSortMapperInterface
{
    /**
     * @var string
     */
    protected const SORT_PATTERN = '/([a-z_]*)_(asc|desc)/';

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
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer
     */
    public function fromCompanyBusinessUnitAddressList(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchSortTransfer {
        $restCompanyBusinessUnitAddressSearchSortTransfer = (new RestCompanyBusinessUnitAddressSearchSortTransfer())
            ->setSortParamNames($this->config->getSortParamNames())
            ->setSortParamLocalizedNames($this->config->getSortParamLocalizedNames());

        $sort = null;

        foreach ($companyBusinessUnitAddressListTransfer->getFilterFields() as $filterField) {
            if ($filterField->getType() === CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_SORT) {
                $sort = $filterField->getValue();

                break;
            }
        }

        if ($sort === null) {
            return $restCompanyBusinessUnitAddressSearchSortTransfer;
        }

        $sortFields = $this->config->getSortFields();
        $sortField = preg_replace(static::SORT_PATTERN, '$1', $sort);

        if (!in_array($sortField, $sortFields, true)) {
            return $restCompanyBusinessUnitAddressSearchSortTransfer;
        }

        $sortDirection = preg_replace(static::SORT_PATTERN, '$2', $sort);

        return $restCompanyBusinessUnitAddressSearchSortTransfer->setCurrentSortParam($sort)
            ->setCurrentSortOrder($sortDirection);
    }
}
