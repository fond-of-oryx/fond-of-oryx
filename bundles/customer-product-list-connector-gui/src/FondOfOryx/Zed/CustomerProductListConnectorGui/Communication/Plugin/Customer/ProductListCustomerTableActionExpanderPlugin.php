<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Plugin\Customer;

use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Controller\EditController;
use Generated\Shared\Transfer\ButtonTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\CustomerExtension\Dependency\Plugin\CustomerTableActionExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\CustomerProductListConnectorGuiCommunicationFactory getFactory()
 */
class ProductListCustomerTableActionExpanderPlugin extends AbstractPlugin implements
    CustomerTableActionExpanderPluginInterface
{
    /**
     * @var string
     */
    public const BUTTON_TITLE = 'Assign Product Lists';

    /**
     * @var array
     */
    public const BUTTON_DEFAULT_OPTIONS = [
        'class' => 'btn-edit btn-view',
        'icon' => 'fa-pencil-square-o',
    ];

    /**
     * @param int $idCustomer
     * @param array<\Generated\Shared\Transfer\ButtonTransfer> $buttons
     *
     * @return array<\Generated\Shared\Transfer\ButtonTransfer>
     */
    public function execute(int $idCustomer, array $buttons): array
    {
        $buttons[] = (new ButtonTransfer())
            ->setUrl($this->getEditCustomerProductListConnectionUrl($idCustomer))
            ->setTitle(static::BUTTON_TITLE)
            ->setDefaultOptions(static::BUTTON_DEFAULT_OPTIONS);

        return $buttons;
    }

    /**
     * @param int $idCustomer
     *
     * @return string
     */
    protected function getEditCustomerProductListConnectionUrl(int $idCustomer): string
    {
        return Url::generate(
            EditController::PAGE_EDIT,
            [
                EditController::PARAM_ID_CUSTOMER => $idCustomer,
            ],
        );
    }
}
