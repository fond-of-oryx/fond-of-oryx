<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Table;

use FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Controller\EditController;
use Orm\Zed\ProductList\Persistence\Base\SpyProductList;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCompanyTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AvailableProductListTable extends AbstractProductListTable
{
    /**
     * @var string
     */
    public const REDIRECT_WARNING = 'Your unsaved modification will be lost, are you sure to continue?';

    /**
     * @var bool
     */
    public const IS_CHECKBOX_SET_BY_DEFAULT = false;

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config = parent::configure($config);
        $config->setUrl(
            sprintf(
                'available-product-list-table?%s=%d',
                EditController::PARAM_ID_COMPANY,
                $this->companyTransfer->getIdCompany(),
            ),
        );

        return $config;
    }

    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function prepareQuery(): ModelCriteria
    {
        return $this->spyProductListQuery->clear()
            ->add(
                SpyProductListTableMap::COL_ID_PRODUCT_LIST,
                sprintf(
                    '%s NOT IN (SELECT %s FROM %s WHERE %s != %s)',
                    SpyProductListTableMap::COL_ID_PRODUCT_LIST,
                    SpyProductListCompanyTableMap::COL_FK_PRODUCT_LIST,
                    SpyProductListCompanyTableMap::TABLE_NAME,
                    SpyProductListCompanyTableMap::COL_FK_COMPANY,
                    $this->companyTransfer->getIdCompany(),
                ),
                Criteria::CUSTOM,
            )
            ->withColumn(SpyProductListTableMap::COL_ID_PRODUCT_LIST, static::COL_ID)
            ->withColumn(SpyProductListTableMap::COL_TITLE, static::COL_NAME);
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\Base\SpyProductList $productListEntity
     *
     * @return string
     */
    protected function getAssignedCompanyColumn(SpyProductList $productListEntity): string
    {
        return sprintf(
            '<a href="%s" onclick="return confirm(\'%s\')">%s</a>',
            $this->getEditCompanyProductListConnectionsUrl($this->companyTransfer->getIdCompany()),
            static::REDIRECT_WARNING,
            $this->companyTransfer->getName(),
        );
    }

    /**
     * @param int $idCompany
     *
     * @return string
     */
    protected function getEditCompanyProductListConnectionsUrl(int $idCompany): string
    {
        return sprintf(
            EditController::PAGE_EDIT_WITH_PARAMS,
            EditController::PARAM_ID_COMPANY,
            $idCompany,
        );
    }

    /**
     * @return string
     */
    protected function getCheckboxHeaderName(): string
    {
        return 'Assign';
    }
}
