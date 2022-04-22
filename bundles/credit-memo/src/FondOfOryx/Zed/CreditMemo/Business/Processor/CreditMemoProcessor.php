<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Processor;

use ArrayIterator;
use Countable;
use FondOfOryx\Zed\CreditMemo\CreditMemoConfig;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface;
use FondOfOryx\Zed\CreditMemo\Exception\ProcessorNotFoundException;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface;
use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use IteratorAggregate;
use Psr\Log\LoggerInterface;
use Throwable;

class CreditMemoProcessor implements Countable, IteratorAggregate, CreditMemoProcessorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface>
     */
    protected $processor = [];

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface
     */
    protected $creditMemoRepository;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface
     */
    protected $store;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\CreditMemoConfig
     */
    protected $config;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param array $processor
     * @param \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface $creditMemoRepository
     * @param \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeInterface $store
     * @param \FondOfOryx\Zed\CreditMemo\CreditMemoConfig $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        array $processor,
        CreditMemoRepositoryInterface $creditMemoRepository,
        CreditMemoToStoreFacadeInterface $store,
        CreditMemoConfig $config,
        LoggerInterface $logger
    ) {
        $this->setProcessor($processor);
        $this->creditMemoRepository = $creditMemoRepository;
        $this->store = $store;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param array<string> $processorPluginNames
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer
     */
    public function process(array $processorPluginNames, array $ids): CreditMemoProcessorResponseCollectionTransfer
    {
        $creditMemoCollection = $this->resolveCreditMemos($ids);
        $processor = $this->prepareProcessorPlugins($processorPluginNames);

        $responseCollection = new CreditMemoProcessorResponseCollectionTransfer();
        $count = 0;
        $errorCount = 0;

        foreach ($creditMemoCollection->getCreditMemos() as $creditMemoTransfer) {
            try {
                $response = $this->startProcessing($processor, $creditMemoTransfer);
            } catch (Throwable $exception) {
                $response = $this->createErrorResponse($creditMemoTransfer, $exception);
                $errorCount++;
                $this->logger->error($exception->getMessage(), $exception->getTrace());
            }
            $count++;
            $responseCollection->addStatus($response);
        }
        $responseCollection->setCount($count);
        $responseCollection->setErrorCount($errorCount);

        return $responseCollection;
    }

    /**
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface>
     */
    public function getProcessor(): array
    {
        return $this->processor;
    }

    /**
     * @param string $processorName
     *
     * @throws \FondOfOryx\Zed\CreditMemo\Exception\ProcessorNotFoundException
     *
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface
     */
    public function get(string $processorName): CreditMemoProcessorPluginInterface
    {
        if (array_key_exists($processorName, $this->processor)) {
            return $this->processor[$processorName];
        }

        throw new ProcessorNotFoundException(sprintf('Processor with name %s not found! Please register first!', $processorName));
    }

    /**
     * @param array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface> $processor
     *
     * @return \FondOfOryx\Zed\CreditMemo\Business\Processor\CreditMemoProcessorInterface
     */
    public function setProcessor(array $processor): CreditMemoProcessorInterface
    {
        foreach ($processor as $processorPlugin) {
            $this->addProcessor($processorPlugin);
        }

        return $this;
    }

    /**
     * @param \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface $processorPlugin
     *
     * @return \FondOfOryx\Zed\CreditMemo\Business\Processor\CreditMemoProcessorInterface
     */
    public function addProcessor(CreditMemoProcessorPluginInterface $processorPlugin): CreditMemoProcessorInterface
    {
        $this->processor[$processorPlugin->getName()] = $processorPlugin;

        return $this;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->processor);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->processor);
    }

    /**
     * @param array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface> $processorPlugins
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer
     */
    protected function startProcessing(
        array $processorPlugins,
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoProcessorStatusTransfer {
        $statusResponse = $this->createDefaultResponse($creditMemoTransfer);

        foreach ($processorPlugins as $processorPlugin) {
            if ($processorPlugin->canProcess($creditMemoTransfer)) {
                return $processorPlugin->process($creditMemoTransfer, $statusResponse);
            }
        }

        return $statusResponse;
    }

    /**
     * @param array<string> $processorPlugins
     *
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface>
     */
    protected function prepareProcessorPlugins(array $processorPlugins): array
    {
        if ($processorPlugins === []) {
            return $this->getProcessor();
        }

        $processor = [];
        foreach ($processorPlugins as $processorPluginName) {
            $processor[$processorPluginName] = $this->get($processorPluginName);
        }

        return $processor;
    }

    /**
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer|null
     */
    protected function resolveCreditMemos(array $ids): ?CreditMemoCollectionTransfer
    {
        if ($ids === []) {
            return $this->creditMemoRepository->findUnprocessedCreditMemoByStore($this->store->getCurrentStore(), $this->config->getProcessSizeMax());
        }

        return $this->creditMemoRepository->findUnprocessedCreditMemoByStoreAndIds(
            $this->store->getCurrentStore(),
            $ids,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer
     */
    protected function createDefaultResponse(CreditMemoTransfer $creditMemoTransfer): CreditMemoProcessorStatusTransfer
    {
        $statusResponse = (new CreditMemoProcessorStatusTransfer())
            ->setSuccess(false)
            ->setId($creditMemoTransfer->getIdCreditMemo())
            ->setMessage(sprintf(
                'No credit memo processor available to process order with id %s',
                $creditMemoTransfer->getIdCreditMemo(),
            ));

        return $statusResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     * @param \Throwable $exception
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer
     */
    protected function createErrorResponse(
        CreditMemoTransfer $creditMemoTransfer,
        Throwable $exception
    ): CreditMemoProcessorStatusTransfer {
        return (new CreditMemoProcessorStatusTransfer())
            ->setSuccess(false)
            ->setId($creditMemoTransfer->getIdCreditMemo())
            ->setMessage($exception->getMessage());
    }
}
