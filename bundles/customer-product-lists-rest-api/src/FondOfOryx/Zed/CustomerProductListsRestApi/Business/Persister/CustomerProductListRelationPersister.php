<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister;

use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Throwable;

class CustomerProductListRelationPersister implements CustomerProductListRelationPersisterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface
     */
    protected $customerReader;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface
     */
    protected $deassignableCustomerIdsFilter;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface
     */
    protected $assignableCustomerIdsFilter;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface $customerReader
     * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface $deassignableCustomerIdsFilter
     * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface $assignableCustomerIdsFilter
     * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface $entityManager
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        CustomerReaderInterface $customerReader,
        CustomerIdsFilterInterface $deassignableCustomerIdsFilter,
        CustomerIdsFilterInterface $assignableCustomerIdsFilter,
        CustomerProductListsRestApiEntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->customerReader = $customerReader;
        $this->deassignableCustomerIdsFilter = $deassignableCustomerIdsFilter;
        $this->assignableCustomerIdsFilter = $assignableCustomerIdsFilter;
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
            $this->logger->error('Could not persist customer product list relation.');

            throw $exception;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return void
     */
    public function doPersist(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): void {
        $idProductList = $productListTransfer->getIdProductList();
        $restProductListsAttributesTransfer = $restProductListUpdateRequestTransfer->getProductList();

        if ($idProductList === null || $restProductListsAttributesTransfer === null) {
            return;
        }

        $assignedCustomerIds = $this->customerReader->getIdsByIdProductList($idProductList);

        $assignableCustomerIds = $this->assignableCustomerIdsFilter->filter(
            $assignedCustomerIds,
            $restProductListsAttributesTransfer,
        );

        if (count($assignableCustomerIds) > 0) {
            $this->entityManager->assignCustomersToProductList($assignableCustomerIds, $idProductList);
        }

        $deassignableCustomerIds = $this->deassignableCustomerIdsFilter->filter(
            $assignedCustomerIds,
            $restProductListsAttributesTransfer,
        );

        if (count($deassignableCustomerIds) > 0) {
            $this->entityManager->deassignCustomersFromProductList($deassignableCustomerIds, $idProductList);
        }
    }
}
