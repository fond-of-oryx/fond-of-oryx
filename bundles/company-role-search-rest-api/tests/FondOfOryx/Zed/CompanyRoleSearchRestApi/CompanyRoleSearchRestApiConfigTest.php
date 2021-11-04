<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi;

use Codeception\Test\Unit;

class CompanyRoleSearchRestApiConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig
     */
    protected $companyRoleSearchRestApiConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyRoleSearchRestApiConfig = new CompanyRoleSearchRestApiConfig();
    }

    /**
     * @return void
     */
    public function testGetFulltextSearchFields(): void
    {
        $expected = ['0' => 'name'];
        $this->assertEquals($expected, $this->companyRoleSearchRestApiConfig->getFulltextSearchFields());
    }

    /**
     * @return void
     */
    public function testGetSortFields(): void
    {
        $expected = ['0' => 'name'];

        $this->assertEquals($expected, $this->companyRoleSearchRestApiConfig->getSortFields());
    }

    /**
     * @return void
     */
    public function testGetItemsPerPage(): void
    {
        $this->assertEquals(12, $this->companyRoleSearchRestApiConfig->getItemsPerPage());
    }

    /**
     * @return void
     */
    public function testGetValidItemsPerPageOptions(): void
    {
        $expected = [
            '0' => '12',
            '1' => '24',
            '2' => '36',
        ];

        $this->assertEquals($expected, $this->companyRoleSearchRestApiConfig->getValidItemsPerPageOptions());
    }
}
