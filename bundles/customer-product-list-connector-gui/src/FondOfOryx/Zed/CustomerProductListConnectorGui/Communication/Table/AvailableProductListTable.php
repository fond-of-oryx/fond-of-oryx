<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Table;

use FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Controller\EditController;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AvailableProductListTable extends AbstractProductListTable
{
    /**
     * @var string
     */
    public const CHECKBOX_HEADER_NAME = 'Assign';

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
                EditController::PARAM_ID_CUSTOMER,
                $this->customerTransfer->getIdCustomer(),
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
            ->where(
                sprintf(
                    '%s NOT IN (SELECT %s FROM %s WHERE %s = ?)',
                    SpyProductListTableMap::COL_ID_PRODUCT_LIST,
                    SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST,
                    SpyProductListCustomerTableMap::TABLE_NAME,
                    SpyProductListCustomerTableMap::COL_FK_CUSTOMER,
                ),
                $this->customerTransfer->getIdCustomer(),
            )->withColumn(SpyProductListTableMap::COL_ID_PRODUCT_LIST, static::COL_ID)
            ->withColumn(SpyProductListTableMap::COL_TITLE, static::COL_NAME);
    }

    /**
     * @return string
     */
    protected function getCheckboxHeaderName(): string
    {
        return static::CHECKBOX_HEADER_NAME;
    }
}
