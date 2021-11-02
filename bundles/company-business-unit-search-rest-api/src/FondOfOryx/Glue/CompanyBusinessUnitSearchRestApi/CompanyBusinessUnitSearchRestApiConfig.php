<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi;

use FondOfOryx\Shared\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyBusinessUnitSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH = 'company-business-unit-search';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH = 'company-business-unit-search-resource';

    /**
     * @var string
     */
    public const RESPONSE_CODE_USER_IS_NOT_SPECIFIED = '1000';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_SPECIFIED = 'Authorization header is required';

    /**
     * @return array<string>
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyBusinessUnitSearchRestApiConstants::SORT_FIELDS,
            CompanyBusinessUnitSearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyBusinessUnitSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyBusinessUnitSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyBusinessUnitSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyBusinessUnitSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }

    /**
     * @return array<string>
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
     * @return array<string>
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
