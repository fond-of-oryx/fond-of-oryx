<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Persister;

use Exception;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CustomerProductListRelationPersister implements CustomerProductListRelationPersisterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface
     */
    protected $productListReader;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var array<\FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface>
     */
    protected $customerProductListRelationPostPersistPlugins;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface $productListReader
     * @param \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface $entityManager
     * @param \Psr\Log\LoggerInterface $logger
     * @param array<\FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface> $customerProductListRelationPostPersistPlugins
     */
    public function __construct(
        ProductListReaderInterface $productListReader,
        CustomerProductListConnectorEntityManagerInterface $entityManager,
        LoggerInterface $logger,
        array $customerProductListRelationPostPersistPlugins = []
    ) {
        $this->productListReader = $productListReader;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->customerProductListRelationPostPersistPlugins = $customerProductListRelationPostPersistPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persist(CustomerProductListRelationTransfer $customerProductListRelationTransfer): void
    {
        $self = $this;

        try {
            $this->getTransactionHandler()
                ->handleTransaction(
                    static function () use ($self, $customerProductListRelationTransfer) {
                        $self->doPersist($customerProductListRelationTransfer);
                    },
                );
        } catch (Exception $exception) {
            $this->logger->error('Could not persist customer product list relation.', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $customerProductListRelationTransfer->serialize(),
            ]);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function doPersist(CustomerProductListRelationTransfer $customerProductListRelationTransfer): void
    {
        $idCustomer = $customerProductListRelationTransfer->getIdCustomer();

        if ($idCustomer === null) {
            return;
        }

        $newProductListIds = $customerProductListRelationTransfer->getProductListIds();
        $currentProductListIds = $this->productListReader->getIdsByIdCustomer($idCustomer);

        $productListIdsToAssign = array_diff($newProductListIds, $currentProductListIds);
        $productListIdsToDeAssign = array_diff($currentProductListIds, $newProductListIds);

        if (count($productListIdsToAssign) > 0) {
            $this->entityManager->assignProductListsToCustomer($productListIdsToAssign, $idCustomer);
        }

        if (count($productListIdsToDeAssign) > 0) {
            $this->entityManager->deAssignProductListsFromCustomer($productListIdsToDeAssign, $idCustomer);
        }

        foreach ($this->customerProductListRelationPostPersistPlugins as $customerProductListRelationPostPersistPlugin) {
            $customerProductListRelationTransfer = $customerProductListRelationPostPersistPlugin->postPersist(
                $customerProductListRelationTransfer,
            );
        }
    }
}
