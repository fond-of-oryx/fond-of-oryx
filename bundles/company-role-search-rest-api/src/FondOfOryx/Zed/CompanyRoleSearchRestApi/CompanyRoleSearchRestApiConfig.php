<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi;

use FondOfOryx\Shared\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyRoleSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getFulltextSearchFields(): array
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS,
            CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT,
        );
    }

    /**
     * @return array<string>
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::SORT_FIELDS,
            CompanyRoleSearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }

    /**
     * @return bool
     */
    public function useWhitelistPermissions(): bool
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::USE_WHITELIST_PERMISSIONS,
            false,
        );
    }

    /**
     * @return string
     */
    public function getPascalCasedWhitelistPermissionPrefix(): string
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX,
            CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX_DEFAULT,
        );
    }

    /**
     * @return string
     */
    public function getSnakeCasedWhitelistPermissionPrefix(): string
    {
        return strtolower(
            preg_replace(
                '/(?<!^)[A-Z]/',
                '_$0',
                $this->getPascalCasedWhitelistPermissionPrefix(),
            ),
        );
    }

    /**
     * @return string
     */
    public function getPascalCasedWhitelistPermissionSuffix(): string
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX,
            CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX_DEFAULT,
        );
    }

    /**
     * @return string
     */
    public function getSnakeCasedWhitelistPermissionSuffix(): string
    {
        return strtolower(
            preg_replace(
                '/(?<!^)[A-Z]/',
                '_$0',
                $this->getPascalCasedWhitelistPermissionSuffix(),
            ),
        );
    }
}
