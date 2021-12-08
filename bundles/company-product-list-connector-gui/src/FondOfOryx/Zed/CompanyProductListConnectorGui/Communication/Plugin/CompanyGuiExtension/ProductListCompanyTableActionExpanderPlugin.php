<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Plugin\CompanyGuiExtension;

use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Controller\EditController;
use Generated\Shared\Transfer\ButtonTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\CompanyGuiExtension\Dependency\Plugin\CompanyTableActionExpanderInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\CompanyProductListConnectorGuiCommunicationFactory getFactory()
 */
class ProductListCompanyTableActionExpanderPlugin extends AbstractPlugin implements CompanyTableActionExpanderInterface
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
     * @param array $company
     *
     * @return \Generated\Shared\Transfer\ButtonTransfer
     */
    public function prepareButton(array $company): ButtonTransfer
    {
        return (new ButtonTransfer())
            ->setUrl($this->getEditCompanyProductListConnectionUrl($company[SpyCompanyTableMap::COL_ID_COMPANY]))
            ->setTitle(static::BUTTON_TITLE)
            ->setDefaultOptions(static::BUTTON_DEFAULT_OPTIONS);
    }

    /**
     * @param int $idCompany
     *
     * @return string
     */
    protected function getEditCompanyProductListConnectionUrl(int $idCompany): string
    {
        return Url::generate(
            EditController::PAGE_EDIT,
            [
                EditController::PARAM_ID_COMPANY => $idCompany,
            ],
        );
    }
}
