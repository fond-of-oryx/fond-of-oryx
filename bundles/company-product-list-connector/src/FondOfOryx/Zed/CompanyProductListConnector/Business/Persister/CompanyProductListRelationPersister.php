<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Persister;

use Exception;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CompanyProductListRelationPersister implements CompanyProductListRelationPersisterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface
     */
    protected $productListReader;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var array<\FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface>
     */
    protected $companyProductListRelationPostPersistPlugins;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface $productListReader
     * @param \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface $entityManager
     * @param \Psr\Log\LoggerInterface $logger
     * @param array<\FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface> $companyProductListRelationPostPersistPlugins
     */
    public function __construct(
        ProductListReaderInterface $productListReader,
        CompanyProductListConnectorEntityManagerInterface $entityManager,
        LoggerInterface $logger,
        array $companyProductListRelationPostPersistPlugins = []
    ) {
        $this->productListReader = $productListReader;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->companyProductListRelationPostPersistPlugins = $companyProductListRelationPostPersistPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persist(CompanyProductListRelationTransfer $companyProductListRelationTransfer): void
    {
        $self = $this;

        try {
            $this->getTransactionHandler()
                ->handleTransaction(
                    static function () use ($self, $companyProductListRelationTransfer) {
                        $self->doPersist($companyProductListRelationTransfer);
                    },
                );
        } catch (Exception $exception) {
            $this->logger->error('Could not persist company product list relation.', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $companyProductListRelationTransfer->serialize(),
            ]);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    protected function doPersist(CompanyProductListRelationTransfer $companyProductListRelationTransfer): void
    {
        $idCompany = $companyProductListRelationTransfer->getIdCompany();

        if ($companyProductListRelationTransfer->getIdCompany() === null) {
            return;
        }

        $newProductListIds = $companyProductListRelationTransfer->getProductListIds();
        $currentProductListIds = $this->productListReader->getIdsByIdCompany($idCompany);

        $productListIdsToAssign = array_diff($newProductListIds, $currentProductListIds);
        $productListIdsToDeAssign = array_diff($currentProductListIds, $newProductListIds);

        if (count($productListIdsToAssign) > 0) {
            $this->entityManager->assignProductListsToCompany($productListIdsToAssign, $idCompany);
        }

        if (count($productListIdsToDeAssign) > 0) {
            $this->entityManager->deAssignProductListsFromCompany($productListIdsToDeAssign, $idCompany);
        }

        foreach ($this->companyProductListRelationPostPersistPlugins as $companyProductListRelationPostPersistPlugin) {
            $companyProductListRelationTransfer = $companyProductListRelationPostPersistPlugin->postPersist(
                $companyProductListRelationTransfer,
            );
        }
    }
}
