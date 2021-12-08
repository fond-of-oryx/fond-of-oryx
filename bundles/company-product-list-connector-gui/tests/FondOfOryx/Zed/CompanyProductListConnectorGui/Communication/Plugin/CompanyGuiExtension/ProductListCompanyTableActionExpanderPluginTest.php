<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Plugin\CompanyGuiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Controller\EditController;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Service\UtilText\Model\Url\Url;

class ProductListCompanyTableActionExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Plugin\CompanyGuiExtension\ProductListCompanyTableActionExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new ProductListCompanyTableActionExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testPrepareButton(): void
    {
        $idCompany = 1;
        $company = [
            SpyCompanyTableMap::COL_ID_COMPANY => $idCompany,
        ];

        $buttonTransfer = $this->plugin->prepareButton($company);

        static::assertEquals(
            Url::generate(EditController::PAGE_EDIT, [EditController::PARAM_ID_COMPANY => $idCompany]),
            $buttonTransfer->getUrl(),
        );

        static::assertEquals(
            ProductListCompanyTableActionExpanderPlugin::BUTTON_TITLE,
            $buttonTransfer->getTitle(),
        );

        static::assertEquals(
            ProductListCompanyTableActionExpanderPlugin::BUTTON_DEFAULT_OPTIONS,
            $buttonTransfer->getDefaultOptions(),
        );
    }
}
