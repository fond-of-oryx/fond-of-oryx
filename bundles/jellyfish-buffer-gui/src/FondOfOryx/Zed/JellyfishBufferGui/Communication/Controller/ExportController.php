<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Communication\Controller;

use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Communication\JellyfishBufferGuiCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface getQueryContainer()
 */
class ExportController extends AbstractController
{
    /**
     * @var string
     */
    public const URL_PARAM_ID_STORE = 'id-store';

    /**
     * @var string
     */
    public const URL_PARAM_ID_EXPORTED_ORDER = 'id-exported-order';

    /**
     * @var string
     */
    public const URL_PARAM_ID_SALES_ORDER = 'id-sales-order';

    /**
     * @var string
     */
    public const URL_PARAM_STATUS = 'status';

    /**
     * @var string
     */
    public const URL_REDIRECT = '/jellyfish-buffer-gui/index/view';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function doAction(Request $request)
    {
        $idStore = $this->extractStoreId($request);
        $idExportedOrder = $this->extractExportedOrderId($request);
        $currentUser = $this->getCurrentUser($request);

        $config = (new ExportedOrderConfigTransfer())->setUser($currentUser);

        $exportedOrder = $this->getFactory()->getJellyfishBufferFacade()->getExportedOrderById($idExportedOrder);

        $store = $this->getFactory()->getStoreFacade()->getStoreById($idStore);

        if ($exportedOrder->getStore() !== $store->getName()) {
            return $this->createRedirectResponse($idStore, $idExportedOrder, false);
        }

        $status = $this->getFactory()->getJellyfishBufferFacade()->export($exportedOrder, $config);

        return $this->createRedirectResponse($idStore, $idExportedOrder, $status);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function listAction(Request $request)
    {
        $idSalesOrder = $this->castId($request->query->getInt(static::URL_PARAM_ID_SALES_ORDER));
        $idStore = $this->extractStoreId($request);
        $exportedOrderCollection = $this->getFactory()->getJellyfishBufferFacade()->findExportedOrdersByFkSalesOrder($idSalesOrder);

        $exportedOrderData = [];
        foreach ($exportedOrderCollection->getOrders() as $exportedOrder) {
            $idExportedOrder = $exportedOrder->getIdExportedOrder();
            $exportedOrderData[$idExportedOrder]['exportedOrder'] = $exportedOrder->toArray();
            $exportedOrderData[$idExportedOrder]['exportedOrderHistory'] = $this->getFactory()->getJellyfishBufferFacade()->findHistoryEntriesByIdExportedOrder($idExportedOrder)->getOrderHistory()->getArrayCopy();
        }

        return [
            'orderCollection' => $exportedOrderData,
            'idStore' => $idStore,
        ];
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
     * @return int
     */
    protected function extractExportedOrderId(Request $request): int
    {
        return $request->query->getInt(static::URL_PARAM_ID_EXPORTED_ORDER);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\UserTransfer|null
     */
    protected function getCurrentUser(Request $request): ?UserTransfer
    {
        return $request->getSession()->get('user:currentUser');
    }

    /**
     * @param int|null $idStore
     * @param int $idExportedOrder
     * @param bool $status
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponse(?int $idStore, int $idExportedOrder, bool $status): RedirectResponse
    {
        return $this->redirectResponse(
            Url::generate(
                static::URL_REDIRECT,
                [
                    static::URL_PARAM_ID_STORE => $idStore,
                    static::URL_PARAM_ID_EXPORTED_ORDER => $idExportedOrder,
                    static::URL_PARAM_STATUS => $status,
                ],
            ),
        );
    }
}
