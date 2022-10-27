<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister;

use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Throwable;

class CompanyProductListRelationPersister implements CompanyProductListRelationPersisterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface
     */
    protected $deassignableCompanyIdsFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface
     */
    protected $assignableCompanyIdsFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface
     */
    protected $companyReader;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface $deassignableCompanyIdsFilter
     * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface $assignableCompanyIdsFilter
     * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface $companyReader
     * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface $entityManager
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        CompanyIdsFilterInterface $deassignableCompanyIdsFilter,
        CompanyIdsFilterInterface $assignableCompanyIdsFilter,
        CompanyReaderInterface $companyReader,
        CompanyProductListsRestApiEntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->deassignableCompanyIdsFilter = $deassignableCompanyIdsFilter;
        $this->assignableCompanyIdsFilter = $assignableCompanyIdsFilter;
        $this->companyReader = $companyReader;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @throws \Throwable
     *
     * @return void
     */
    public function persist(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): void {
        $self = $this;

        try {
            $this->getTransactionHandler()
                ->handleTransaction(
                    static function () use ($self, $restProductListUpdateRequestTransfer, $productListTransfer) {
                        $self->doPersist($restProductListUpdateRequestTransfer, $productListTransfer);
                    },
                );
        } catch (Throwable $exception) {
            $this->logger->error('Could not persist company product list relation.');

            throw $exception;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return void
     */
    protected function doPersist(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): void {
        $idProductList = $productListTransfer->getIdProductList();

        if ($idProductList === null) {
            return;
        }

        $assignedCompanyIds = $this->companyReader->getIdsByIdProductList($idProductList);

        $assignableCompanyIds = $this->assignableCompanyIdsFilter->filter(
            $assignedCompanyIds,
            $restProductListUpdateRequestTransfer,
        );

        if (count($assignableCompanyIds) > 0) {
            $this->entityManager->assignCompaniesToProductList($assignableCompanyIds, $idProductList);
        }

        $deassignableCompanyIds = $this->deassignableCompanyIdsFilter->filter(
            $assignedCompanyIds,
            $restProductListUpdateRequestTransfer,
        );

        if (count($deassignableCompanyIds) > 0) {
            $this->entityManager->deassignCompaniesFromProductList($deassignableCompanyIds, $idProductList);
        }
    }
}
