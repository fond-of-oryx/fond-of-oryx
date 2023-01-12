<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Communication\Table;

use FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;
use Orm\Zed\JellyfishBuffer\Persistence\Map\FooExportedOrderTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Orm\Zed\Store\Persistence\Map\SpyStoreTableMap;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class ExportedOrderTable extends AbstractTable
{
    /**
     * @var string
     */
    public const TABLE_COL_ACTION = 'Actions';

    /**
     * @var string
     */
    public const URL_PARAM_ID_EXPORTED_ORDER = 'id-exported-order';

    /**
     * @var string
     */
    public const URL_PARAM_ID_STORE = 'id-store';

    /**
     * @var \FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var int
     */
    protected $idStore;

    /**
     * @param \FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface $queryContainer
     * @param int $idStore
     */
    public function __construct(
        JellyfishBufferGuiToStoreFacadeInterface $storeFacade,
        JellyfishBufferGuiQueryContainerInterface $queryContainer,
        int $idStore
    ) {
        $this->storeFacade = $storeFacade;
        $this->queryContainer = $queryContainer;
        $this->idStore = $idStore;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $url = Url::generate(
            '/jellyfish-buffer-table',
            [
               static::URL_PARAM_ID_STORE => $this->idStore,
            ],
        );

        $config->setUrl($url);
        $config->setHeader([
            SpySalesOrderTableMap::COL_ID_SALES_ORDER => 'ID',
            SpySalesOrderTableMap::COL_ORDER_REFERENCE => 'Order Reference',
            SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE => 'Customer Reference',
            SpySalesOrderTableMap::COL_EMAIL => 'Customer E-Mail',
            SpyStoreTableMap::COL_NAME => 'Store',
            FooExportedOrderTableMap::COL_CREATED_AT => 'Exported at',
            FooExportedOrderTableMap::COL_UPDATED_AT => 'Last export at',
            FooExportedOrderTableMap::COL_IS_REEXPORTED => 'Was reexported',
            static::TABLE_COL_ACTION => 'Actions',
        ]);

        $config->setSortable([
            SpySalesOrderTableMap::COL_ID_SALES_ORDER,
            SpySalesOrderTableMap::COL_ORDER_REFERENCE,
            SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE,
            SpySalesOrderTableMap::COL_EMAIL,
            FooExportedOrderTableMap::COL_CREATED_AT,
            FooExportedOrderTableMap::COL_UPDATED_AT,
        ]);

        $config->setSearchable([
            SpySalesOrderTableMap::COL_ORDER_REFERENCE,
            SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE,
            SpySalesOrderTableMap::COL_EMAIL,
        ]);

        $config->addRawColumn(static::TABLE_COL_ACTION);
        $config->addRawColumn(SpySalesOrderTableMap::COL_ORDER_REFERENCE);

        $config->setDefaultSortField(SpySalesOrderTableMap::COL_ORDER_REFERENCE, TableConfiguration::SORT_DESC);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $result = [];
        $query = $this->queryContainer->getExportedOrderQuery($this->storeFacade->getStoreById($this->idStore)->getName());
        /** @var \Propel\Runtime\Collection\ObjectCollection $exportedOrderEntities|array<\Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder> */
        $exportedOrderEntities = $this->runQuery($query, $config, true);

        foreach ($exportedOrderEntities as $exportedOrderEntity) {
            $isReExported = $this->wasReexported($exportedOrderEntity);
            $order = $exportedOrderEntity->getOrder();

            $result[] = [
                SpySalesOrderTableMap::COL_ID_SALES_ORDER => $exportedOrderEntity->getIdExportedOrder(),
                SpySalesOrderTableMap::COL_ORDER_REFERENCE => $this->getSalesOrderPageLink($exportedOrderEntity->getOrderReference(), $order->getIdSalesOrder()),
                SpySalesOrderTableMap::COL_CUSTOMER_REFERENCE => $order->getCustomerReference(),
                SpySalesOrderTableMap::COL_EMAIL => $order->getEmail(),
                SpyStoreTableMap::COL_NAME => $exportedOrderEntity->getStore(),
                FooExportedOrderTableMap::COL_CREATED_AT => $exportedOrderEntity->getCreatedAt()->format('Y-m-d H:i:s.u'),
                FooExportedOrderTableMap::COL_UPDATED_AT => $exportedOrderEntity->getUpdatedAt()->format('Y-m-d H:i:s.u'),
                FooExportedOrderTableMap::COL_IS_REEXPORTED => $isReExported ? 'Yes' : 'No',
                static::TABLE_COL_ACTION => $this->createViewButton($exportedOrderEntity),
            ];
        }

        return $result;
    }

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder $exportedOrder
     *
     * @return bool
     */
    protected function wasReexported(FooExportedOrder $exportedOrder): bool
    {
        return $exportedOrder->getIsReexported() === true;
    }

    /**
     * @param string $orderReference
     * @param int $idSalesOrder
     *
     * @return string
     */
    protected function getSalesOrderPageLink($orderReference, $idSalesOrder)
    {
        $pageViewUrl = Url::generate('/sales/detail', [
            'id-sales-order' => $idSalesOrder,
        ])->build();

        return sprintf('<a target="_blank" href="%s">%s</a>', $pageViewUrl, $orderReference);
    }

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder $exportedOrderEntity
     *
     * @return string
     */
    protected function createViewButton(FooExportedOrder $exportedOrderEntity)
    {
        $viewTaxSetUrl = Url::generate(
            '/jellyfish-buffer-gui/index/view',
            [
                static::URL_PARAM_ID_EXPORTED_ORDER => $exportedOrderEntity->getIdExportedOrder(),
                static::URL_PARAM_ID_STORE => $this->idStore,
            ],
        );

        return $this->generateViewButton($viewTaxSetUrl, 'View');
    }
}
