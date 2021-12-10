<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Plugin\Customer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Controller\EditController;
use Spryker\Service\UtilText\Model\Url\Url;

class ProductListCustomerTableActionExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Plugin\Customer\ProductListCustomerTableActionExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new ProductListCustomerTableActionExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $idCustomer = 1;
        $buttonTransfers = $this->plugin->execute($idCustomer, []);

        static::assertCount(1, $buttonTransfers);

        static::assertEquals(
            Url::generate(EditController::PAGE_EDIT, [EditController::PARAM_ID_CUSTOMER => $idCustomer]),
            $buttonTransfers[0]->getUrl(),
        );

        static::assertEquals(
            ProductListCustomerTableActionExpanderPlugin::BUTTON_TITLE,
            $buttonTransfers[0]->getTitle(),
        );

        static::assertEquals(
            ProductListCustomerTableActionExpanderPlugin::BUTTON_DEFAULT_OPTIONS,
            $buttonTransfers[0]->getDefaultOptions(),
        );
    }
}
