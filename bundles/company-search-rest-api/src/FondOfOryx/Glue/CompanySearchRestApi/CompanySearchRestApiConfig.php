<?php

namespace FondOfOryx\Glue\CompanySearchRestApi;

use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanySearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_COMPANY_SEARCH = 'company-search';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_COMPANY_SEARCH = 'company-search-resource';

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
            CompanySearchRestApiConstants::SORT_FIELDS,
            CompanySearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanySearchRestApiConstants::ITEMS_PER_PAGE,
            CompanySearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanySearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
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
            $sortParamLocalizedNames[$sortParamName] = sprintf('companies_rest_api.sort.%s', $sortParamName);
        }

        return $sortParamLocalizedNames;
    }
}
