<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class SeeAllCompanyBusinessUnitQuotesPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\PermissionExtension\SeeAllCompanyBusinessUnitQuotesPermissionPlugin
     */
    protected $seeAllCompanyBusinessUnitQuotesPermissionPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->seeAllCompanyBusinessUnitQuotesPermissionPlugin = new SeeAllCompanyBusinessUnitQuotesPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertEquals(
            SeeAllCompanyBusinessUnitQuotesPermissionPlugin::KEY,
            $this->seeAllCompanyBusinessUnitQuotesPermissionPlugin->getKey(),
        );
    }
}
