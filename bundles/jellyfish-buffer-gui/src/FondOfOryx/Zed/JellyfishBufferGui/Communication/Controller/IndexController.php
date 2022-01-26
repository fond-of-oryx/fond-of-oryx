<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Communication\Controller;

use FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderHistoryTable;
use FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderTable;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Communication\JellyfishBufferGuiCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface getQueryContainer()
 */
class IndexController extends AbstractController
{
    /**
     * @var string
     */
    public const EXPORTED_ORDER_LIST_URL = '/jellyfish-buffer-gui/index';

    /**
     * @var string
     */
    public const URL_PARAM_ID_STORE = 'id-store';

    /**
     * @var string
     */
    public const URL_PARAM_STATUS = 'status';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $idStore = $this->extractStoreId($request);

        $availabilityAbstractTable = $this->getExportedOrderTable($idStore);

        $storeTransfer = $this->getFactory()->getStoreFacade()->getCurrentStore();
        $stores = $this->getFactory()->getStoreFacade()->getStoresWithSharedPersistence($storeTransfer);
        $stores[] = $storeTransfer;

        return [
            'indexTable' => $availabilityAbstractTable->render(),
            'stores' => $stores,
            'idStore' => $idStore,
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function jellyfishBufferTableAction(Request $request)
    {
        $idStore = $this->extractStoreId($request);

        $availabilityAbstractTable = $this->getExportedOrderTable($idStore);

        return $this->jsonResponse(
            $availabilityAbstractTable->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function jellyfishBufferHistoryTableAction(Request $request)
    {
        $idExportedOrder = $this->castId($request->query->getInt(ExportedOrderTable::URL_PARAM_ID_EXPORTED_ORDER));
        $exportedOrder = $this->getFactory()->getJellyfishBufferFacade()->getExportedOrderById($idExportedOrder);
        $availabilityAbstractTable = $this->getExportedOrderHistoryTable($exportedOrder);

        return $this->jsonResponse(
            $availabilityAbstractTable->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function viewAction(Request $request)
    {
        $idStore = $this->extractStoreId($request);
        $idExportedOrder = $this->castId($request->query->getInt(ExportedOrderTable::URL_PARAM_ID_EXPORTED_ORDER));
        $exportedOrder = $this->getFactory()->getJellyfishBufferFacade()->getExportedOrderById($idExportedOrder);
        $exportedOrderHistory = $this->getExportedOrderHistoryTable($exportedOrder);
        $status = $this->extractExportStatus($request);

        return [
            'indexTable' => $exportedOrderHistory->render(),
            'exportedOrder' => $exportedOrder,
            'idStore' => $idStore,
            'idExportedOrder' => $idExportedOrder,
            'exportState' => $status ?? '',
        ];
    }

    /**
     * @param int $idStore
     *
     * @return \FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderTable
     */
    protected function getExportedOrderTable(int $idStore): ExportedOrderTable
    {
        return $this->getFactory()->createExportedOrderTable($idStore);
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     *
     * @return \FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderHistoryTable
     */
    protected function getExportedOrderHistoryTable(ExportedOrderTransfer $exportedOrderTransfer): ExportedOrderHistoryTable
    {
        return $this->getFactory()->createExportedOrderHistoryTable($exportedOrderTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return int|null
     */
    protected function extractStoreId(Request $request): ?int
    {
        $idStore = $request->query->getInt(static::URL_PARAM_ID_STORE);
        if (!$idStore) {
            $idStore = $this->getFactory()->getStoreFacade()->getCurrentStore()->getIdStore();
        }

        return $this->castId($idStore);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return int|null
     */
    protected function extractExportStatus(Request $request): ?int
    {
        return $request->query->get(static::URL_PARAM_STATUS);
    }
}
