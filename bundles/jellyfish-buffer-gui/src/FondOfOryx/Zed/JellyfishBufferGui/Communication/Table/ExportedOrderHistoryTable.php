<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Communication\Table;

use FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToJellyfishBufferInterface;
use FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiConfig;
use FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\Map\FooExportedOrderHistoryTableMap;
use Orm\Zed\JellyfishBuffer\Persistence\Map\FooExportedOrderTableMap;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderTableMap;
use Orm\Zed\User\Persistence\Map\SpyUserTableMap;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class ExportedOrderHistoryTable extends AbstractTable
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
     * @var \FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToJellyfishBufferInterface
     */
    protected $jellyfishBufferFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    protected $exportedOrderTransfer;

    /**
     * @var \FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiConfig
     */
    protected $bundleConfig;

    /**
     * @param \FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToJellyfishBufferInterface $jellyfishBufferFacade
     * @param \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface $queryContainer
     * @param \FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiConfig $bundleConfig
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     */
    public function __construct(
        JellyfishBufferGuiToJellyfishBufferInterface $jellyfishBufferFacade,
        JellyfishBufferGuiQueryContainerInterface $queryContainer,
        JellyfishBufferGuiConfig $bundleConfig,
        ExportedOrderTransfer $exportedOrderTransfer
    ) {
        $this->jellyfishBufferFacade = $jellyfishBufferFacade;
        $this->queryContainer = $queryContainer;
        $this->bundleConfig = $bundleConfig;
        $this->exportedOrderTransfer = $exportedOrderTransfer;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $url = Url::generate(
            '/jellyfish-buffer-history-table',
            [
                static::URL_PARAM_ID_EXPORTED_ORDER => $this->exportedOrderTransfer->getIdExportedOrder(),
            ],
        );

        $config->setUrl($url);
        $config->setHeader([
            FooExportedOrderTableMap::COL_ID_EXPORTED_ORDER => 'ID',
            SpySalesOrderTableMap::COL_ORDER_REFERENCE => 'Order Reference',
            FooExportedOrderHistoryTableMap::COL_CONFIG => 'Configuration',
            FooExportedOrderHistoryTableMap::COL_DATA => 'Data',
            sprintf('%s %s', SpyUserTableMap::COL_FIRST_NAME, SpyUserTableMap::COL_LAST_NAME) => 'Exported by',
            FooExportedOrderHistoryTableMap::COL_EXPORTED_AT => 'Date',
        ]);

        $config->setSortable([
            FooExportedOrderHistoryTableMap::COL_EXPORTED_AT,
            sprintf('%s %s', SpyUserTableMap::COL_FIRST_NAME, SpyUserTableMap::COL_LAST_NAME),
        ]);

        $config->setSearchable([
            SpyUserTableMap::COL_LAST_NAME,
            SpyUserTableMap::COL_FIRST_NAME,
        ]);

        $config->addRawColumn(static::TABLE_COL_ACTION);
        $config->setDefaultSortField(FooExportedOrderHistoryTableMap::COL_EXPORTED_AT, TableConfiguration::SORT_DESC);

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
        $query = $this->queryContainer->getExportedOrderHistoryQuery();

        $exportedOrder = $this->jellyfishBufferFacade->getExportedOrderById($this->exportedOrderTransfer->getIdExportedOrder());
        $order = $exportedOrder->getOrder();

        $query->filterByFkExportedOrder($exportedOrder->getIdExportedOrder());

        /** @var \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistory> $exportedOrderHistoryEntities */
        $exportedOrderHistoryEntities = $this->runQuery($query, $config, true);

        foreach ($exportedOrderHistoryEntities as $exportedOrderHistoryEntity) {
            $user = $exportedOrderHistoryEntity->getSpyUser();

            $result[] = [
                FooExportedOrderTableMap::COL_ID_EXPORTED_ORDER => $exportedOrderHistoryEntity->getFkExportedOrder(),
                SpySalesOrderTableMap::COL_ORDER_REFERENCE => $order->getOrderReference(),
                FooExportedOrderHistoryTableMap::COL_CONFIG => $exportedOrderHistoryEntity->getConfig(),
                FooExportedOrderHistoryTableMap::COL_DATA => $this->anonymizeData($exportedOrderHistoryEntity->getData()),
                sprintf('%s %s', SpyUserTableMap::COL_FIRST_NAME, SpyUserTableMap::COL_LAST_NAME) => sprintf('%s %s', $user->getFirstName(), $user->getLastName()),
                FooExportedOrderHistoryTableMap::COL_EXPORTED_AT => $exportedOrderHistoryEntity->getExportedAt()->format('Y-m-d H:i:s.u'),
            ];
        }

        return $result;
    }

    /**
     * @param string $jsonString
     *
     * @return string
     */
    protected function anonymizeData(string $jsonString): string
    {
        $data = json_decode($jsonString, true);

        foreach ($this->bundleConfig->getAnonymizationData() as $key => $replacement) {
            if (array_key_exists($key, $data)) {
                $data[$key] = $replacement;
            }
        }

        return json_encode($data);
    }
}
