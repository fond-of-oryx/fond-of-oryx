<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Model;

use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface;
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
     * @var string
     */
    protected const KEY_ID_ERP_ORDER = 'id_erp_order';

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface
     */
    protected $erpOrderFacade;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface $erpOrderFacade
     * @param \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface $repository
     */
    public function __construct(
        ErpOrderApiToApiFacadeInterface $apiFacade,
        ErpOrderApiToErpOrderFacadeInterface $erpOrderFacade,
        ErpOrderApiRepositoryInterface $repository
    ) {
        $this->apiFacade = $apiFacade;
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
        $erpOrderTransfer = (new ErpOrderTransfer())->fromArray($apiDataTransfer->getData(), true);
        $erpOrderResponseTransfer = $this->erpOrderFacade->createErpOrder($erpOrderTransfer);
        $erpOrderTransfer = $erpOrderResponseTransfer->getErpOrder();

        if ($erpOrderTransfer === null || !$erpOrderResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create erp order.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $erpOrderTransfer,
            (string)$erpOrderTransfer->getIdErpOrder(),
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
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $erpOrderTransfer,
            (string)$erpOrderTransfer->getIdErpOrder(),
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

        return $this->apiFacade->createApiItem($erpOrderTransfer, (string)$idErpOrder);
    }

    /**
     * @TODO add pagination
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $data = [];
        $apiCollectionTransfer = $this->repository->find($apiRequestTransfer);

        foreach ($apiCollectionTransfer->getData() as $index => $item) {
            if (!isset($item[static::KEY_ID_ERP_ORDER])) {
                continue;
            }

            $data[$index] = $this->getByIdErpOrder($item[static::KEY_ID_ERP_ORDER])->toArray();
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

        return $this->apiFacade->createApiItem(null, (string)$idErpOrder);
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
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $erpOrderTransfer;
    }
}
