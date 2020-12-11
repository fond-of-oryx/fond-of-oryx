<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Model;

use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class ErpOrderApi implements ErpOrderApiInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface
     */
    protected $erpOrderFacade;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface $erpOrderFacade
     * @param \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface $repository
     */
    public function __construct(
        ErpOrderApiToApiQueryContainerInterface $apiQueryContainer,
        ErpOrderApiToErpOrderFacadeInterface $erpOrderFacade,
        ErpOrderApiRepositoryInterface $repository
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->erpOrderFacade = $erpOrderFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function create(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $erpOrderTransfer = (new ErpOrderTransfer())->fromArray($apiDataTransfer->getData());
        $erpOrderResponseTransfer = $this->erpOrderFacade->createErpOrder($erpOrderTransfer);
        $erpOrderTransfer = $erpOrderResponseTransfer->getErpOrder();

        if ($erpOrderTransfer === null || !$erpOrderResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create erp order.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $erpOrderTransfer,
            $erpOrderTransfer->getIdErpOrder()
        );
    }

    /**
     * @param int $idErpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idErpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $this->getByIdErpOrder($idErpOrder);

        $erpOrderTransfer = (new ErpOrderTransfer())
            ->fromArray($apiDataTransfer->getData(), true)
            ->setIdErpOrder($idErpOrder);

        $erpOrderResponseTransfer = $this->erpOrderFacade->updateErpOrder($erpOrderTransfer);
        $erpOrderTransfer = $erpOrderResponseTransfer->getErpOrder();

        if ($erpOrderTransfer === null || !$erpOrderResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not update erp order.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $erpOrderTransfer,
            $erpOrderTransfer->getIdErpOrder()
        );
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idErpOrder): ApiItemTransfer
    {
        $erpOrderTransfer = $this->getByIdErpOrder($idErpOrder);

        return $this->apiQueryContainer->createApiItem($erpOrderTransfer, $idErpOrder);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $data = [];
        $apiCollectionTransfer = $this->repository->find($apiRequestTransfer);

        foreach ($apiCollectionTransfer->getData() as $item) {
            if (!isset($item['id_erp_order'])) {
                continue;
            }

            $data[] = $this->get($item['id_erp_order'])
                ->getData();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function delete(int $idErpOrder): ApiItemTransfer
    {
        $this->getByIdErpOrder($idErpOrder);

        $this->erpOrderFacade->deleteErpOrderByIdErpOrder($idErpOrder);

        return $this->apiQueryContainer->createApiItem(new ErpOrderTransfer(), $idErpOrder);
    }

    /**
     * @param int $idErpOrder
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    protected function getByIdErpOrder(int $idErpOrder): ErpOrderTransfer
    {
        $erpOrderTransfer = $this->erpOrderFacade->findErpOrderByIdErpOrder($idErpOrder);

        if ($erpOrderTransfer === null) {
            throw new EntityNotFoundException(
                sprintf('Could not found erp order.'),
                ApiConfig::HTTP_CODE_NOT_FOUND
            );
        }

        return $erpOrderTransfer;
    }
}
