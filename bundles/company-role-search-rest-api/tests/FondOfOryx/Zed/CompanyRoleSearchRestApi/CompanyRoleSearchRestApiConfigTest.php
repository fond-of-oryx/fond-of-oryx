<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConstants;

class CompanyRoleSearchRestApiConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(CompanyRoleSearchRestApiConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetFulltextSearchFields(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS,
                CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT,
            $this->config->getFulltextSearchFields(),
        );
    }

    /**
     * @return void
     */
    public function testGetSortFields(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::SORT_FIELDS,
                CompanyRoleSearchRestApiConstants::SORT_FIELDS_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::SORT_FIELDS_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::SORT_FIELDS_DEFAULT,
            $this->config->getSortFields(),
        );
    }

    /**
     * @return void
     */
    public function testGetItemsPerPage(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE,
                CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
            $this->config->getItemsPerPage(),
        );
    }

    /**
     * @return void
     */
    public function testGetValidItemsPerPageOptions(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
                CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
            $this->config->getValidItemsPerPageOptions(),
        );
    }

    /**
     * @return void
     */
    public function testUseWhitelistPermissions(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::USE_WHITELIST_PERMISSIONS,
                CompanyRoleSearchRestApiConstants::USE_WHITELIST_PERMISSIONS_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::USE_WHITELIST_PERMISSIONS_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::USE_WHITELIST_PERMISSIONS_DEFAULT,
            $this->config->useWhitelistPermissions(),
        );
    }

    /**
     * @return void
     */
    public function testGetPascalCasedWhitelistPermissionPrefix(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX,
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX_DEFAULT,
            $this->config->getPascalCasedWhitelistPermissionPrefix(),
        );
    }

    /**
     * @return void
     */
    public function testGetPascalCasedWhitelistPermissionSuffix(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX,
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX_DEFAULT,
            )->willReturn(
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX_DEFAULT,
            );

        static::assertEquals(
            CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX_DEFAULT,
            $this->config->getPascalCasedWhitelistPermissionSuffix(),
        );
    }

    /**
     * @return void
     */
    public function testGetSnakeCasedWhitelistPermissionPrefix(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX,
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_PREFIX_DEFAULT,
            )->willReturn(
                'FooBar',
            );

        static::assertEquals(
            'foo_bar',
            $this->config->getSnakeCasedWhitelistPermissionPrefix(),
        );
    }

    /**
     * @return void
     */
    public function testGetSnakeCasedWhitelistPermissionSuffix(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX,
                CompanyRoleSearchRestApiConstants::WHITELIST_PERMISSION_SUFFIX_DEFAULT,
            )->willReturn(
                'FooBar',
            );

        static::assertEquals(
            'foo_bar',
            $this->config->getSnakeCasedWhitelistPermissionSuffix(),
        );
    }
}
