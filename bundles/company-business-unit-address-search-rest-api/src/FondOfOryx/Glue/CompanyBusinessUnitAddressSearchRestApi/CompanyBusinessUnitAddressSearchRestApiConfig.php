<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi;

use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyBusinessUnitAddressSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESS_SEARCH = 'company-business-unit-address-search';
    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESS_SEARCH = 'company-business-unit-address-search-resource';

    /**
     * @var string
     */
    public const RESPONSE_CODE_USER_IS_NOT_SPECIFIED = '1000';
    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_SPECIFIED = 'Authorization header is required';

    /**
     * @return string[]
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyBusinessUnitAddressSearchRestApiConstants::SORT_FIELDS,
            CompanyBusinessUnitAddressSearchRestApiConstants::SORT_FIELDS_DEFAULT
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyBusinessUnitAddressSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyBusinessUnitAddressSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT
        );
    }

    /**
     * @return int[]
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyBusinessUnitAddressSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyBusinessUnitAddressSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT
        );
    }

    /**
     * @return string[]
     */
    public function getSortParamNames(): array
    {
        $sortParamNames = [];

        foreach ($this->getSortFields() as $sortField) {
            $sortParamNames[] = sprintf('%s_asc', $sortField);
            $sortParamNames[] = sprintf('%s_desc', $sortField);
        }

        return $sortParamNames;
    }

    /**
     * @return string[]
     */
    public function getSortParamLocalizedNames(): array
    {
        $sortParamLocalizedNames = [];

        foreach ($this->getSortParamNames() as $sortParamName) {
            $sortParamLocalizedNames[$sortParamName] = sprintf('company_business-units_rest_api.sort.%s', $sortParamName);
        }

        return $sortParamLocalizedNames;
    }
}
