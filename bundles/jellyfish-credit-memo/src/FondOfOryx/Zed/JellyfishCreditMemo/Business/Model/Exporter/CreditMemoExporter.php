<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter;

use Exception;
use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig;
use FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface;
use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Spryker\Shared\Log\LoggerTrait;

class CreditMemoExporter implements CreditMemoExporterInterface
{
    use LoggerTrait;

    protected const CREDIT_MEMO_EXPORT_STATE_COMPLETE = 'complete';

    protected const EXPORT_STATES = [
        CreditMemoConstants::STATE_ERROR,
        CreditMemoConstants::STATE_COMPLETE,
    ];

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface
     */
    protected $adapter;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface
     */
    protected $jellyfishCreditMemoEntityManager;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface
     */
    protected $jellyfishCreditMemoMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface
     */
    protected $jellyfishCreditMemoRepository;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig
     */
    protected $jellyfishCreditMemoConfig;

    /**
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface $jellyfishCreditMemoMapper
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface $jellyfishCreditMemoRepository
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig $jellyfishCreditMemoConfig
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface $jellyfishCreditMemoEntityManager
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface $adapter
     */
    public function __construct(
        JellyfishCreditMemoMapperInterface $jellyfishCreditMemoMapper,
        JellyfishCreditMemoRepositoryInterface $jellyfishCreditMemoRepository,
        JellyfishCreditMemoConfig $jellyfishCreditMemoConfig,
        JellyfishCreditMemoEntityManagerInterface $jellyfishCreditMemoEntityManager,
        CreditMemoAdapterInterface $adapter
    ) {
        $this->adapter = $adapter;
        $this->jellyfishCreditMemoRepository = $jellyfishCreditMemoRepository;
        $this->jellyfishCreditMemoMapper = $jellyfishCreditMemoMapper;
        $this->jellyfishCreditMemoConfig = $jellyfishCreditMemoConfig;
        $this->jellyfishCreditMemoEntityManager = $jellyfishCreditMemoEntityManager;
    }

    /**
     * Export data
     *
     * @throws \Exception
     *
     * @return void
     */
    public function export(): void
    {
        try {
            $creditMemoCollectionTransfer = $this->jellyfishCreditMemoRepository->findPendingCreditMemoCollection();

            if ($creditMemoCollectionTransfer->getCreditMemos()->count() === 0) {
                return;
            }

            $this->handle($creditMemoCollectionTransfer);
        } catch (Exception $exception) {
            $this->getLogger()->error(sprintf(
                'CreditMemo could not expoted to JellyFish! Message: %s',
                $exception->getMessage()
            ), $exception->getTrace());

            throw $exception;
        }
    }

    /**
     * @param int $salesOrderId
     * @param array $salesOrderItemIds
     *
     * @return void
     */
    public function exportBySalesOrderIdAndSalesOrderItemIds(int $salesOrderId, array $salesOrderItemIds): void
    {
        $creditMemoTransfer = $this->jellyfishCreditMemoRepository->findCreditMemoBySalesOrderIdAndSalesOrderItemIds($salesOrderId, $salesOrderItemIds);
        if ($creditMemoTransfer !== null) {
            $state = $this->getCreditMemoState($creditMemoTransfer);

            if ($creditMemoTransfer->getJellyfishExportState() === null && in_array($state, static::EXPORT_STATES, true)) {
                $jellyfishCreditMemo = $this->map($creditMemoTransfer);
                $this->adapter->sendRequest($jellyfishCreditMemo);

                $jellyfishCreditMemo->setExportState(static::CREDIT_MEMO_EXPORT_STATE_COMPLETE);
                $this->jellyfishCreditMemoEntityManager->updateExportState($jellyfishCreditMemo);
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoTransfer
     */
    protected function map(CreditMemoTransfer $creditMemoTransfer): JellyfishCreditMemoTransfer
    {
        $jellyfishCreditMemoTransfer = $this->jellyfishCreditMemoMapper
            ->mapCreditMemoTransferToJellyfishCreditMemoTransfer($creditMemoTransfer);

        return $jellyfishCreditMemoTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return bool
     */
    protected function isValidForExport(CreditMemoTransfer $creditMemoTransfer): bool
    {
        if ($creditMemoTransfer->getItems()->count() === 0) {
            return false;
        }

        foreach ($creditMemoTransfer->getItems() as $itemTransfer) {
            if (
                $this->getSalesOrderItemStateName($itemTransfer) !==
                $this->jellyfishCreditMemoConfig->getSalesOrderItemStateRefunded()
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string
     */
    protected function getSalesOrderItemStateName(ItemTransfer $itemTransfer): string
    {
        $itemStateTransfer = $this->jellyfishCreditMemoRepository
            ->findSalesOrderItemStateByIdSalesOrderItem($itemTransfer);

        if ($itemStateTransfer === null) {
            return '';
        }

        return $itemStateTransfer->getName();
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return string
     */
    protected function getCreditMemoState(CreditMemoTransfer $creditMemoTransfer): string
    {
        $state = $creditMemoTransfer->getState();
        if (array_key_exists($state, CreditMemoConstants::STATE_MAPPING)) {
            return $state;
        }

        $state = array_search($state, CreditMemoConstants::STATE_MAPPING);
        if ($state === false) {
            return CreditMemoConstants::STATE_NEW;
        }

        return $state;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoCollectionTransfer $creditMemoCollectionTransfer
     *
     * @return void
     */
    protected function handle(CreditMemoCollectionTransfer $creditMemoCollectionTransfer): void
    {
        foreach ($creditMemoCollectionTransfer->getCreditMemos() as $creditMemoTransfer) {
            if ($this->isValidForExport($creditMemoTransfer) === false) {
                continue;
            }

            $jellyfishCreditMemo = $this->map($creditMemoTransfer);
            $this->adapter->sendRequest($jellyfishCreditMemo);

            $jellyfishCreditMemo->setExportState(static::CREDIT_MEMO_EXPORT_STATE_COMPLETE);
            $this->jellyfishCreditMemoEntityManager->updateExportState($jellyfishCreditMemo);
        }
    }
}
