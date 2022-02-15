<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model;

use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class ErpDeliveryNoteApi implements ErpDeliveryNoteApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_ERP_DELIVERY_NOTE = 'id_erp_delivery_note';

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface
     */
    protected $erpDeliveryNoteFacade;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface $erpDeliveryNoteFacade
     * @param \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface $repository
     */
    public function __construct(
        ErpDeliveryNoteApiToApiQueryContainerInterface $apiQueryContainer,
        ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface $erpDeliveryNoteFacade,
        ErpDeliveryNoteApiRepositoryInterface $repository
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->erpDeliveryNoteFacade = $erpDeliveryNoteFacade;
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
        $erpDeliveryNoteTransfer = (new ErpDeliveryNoteTransfer())->fromArray($apiDataTransfer->getData(), true);
        $erpDeliveryNoteResponseTransfer = $this->erpDeliveryNoteFacade->createErpDeliveryNote($erpDeliveryNoteTransfer);
        $erpDeliveryNoteTransfer = $erpDeliveryNoteResponseTransfer->getErpDeliveryNote();

        if ($erpDeliveryNoteTransfer === null || !$erpDeliveryNoteResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create erp delivery note. %s', $erpDeliveryNoteResponseTransfer->getMessage()),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $erpDeliveryNoteTransfer,
            $erpDeliveryNoteTransfer->getIdErpDeliveryNote(),
        );
    }

    /**
     * @param int $idErpDeliveryNote
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idErpDeliveryNote, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $erpDeliveryNoteTransfer = $this->getByIdErpDeliveryNote($idErpDeliveryNote);
        $erpDeliveryNoteTransfer = $erpDeliveryNoteTransfer->fromArray($apiDataTransfer->getData(), true);

        $erpDeliveryNoteResponseTransfer = $this->erpDeliveryNoteFacade->updateErpDeliveryNote($erpDeliveryNoteTransfer);
        $erpDeliveryNoteTransfer = $erpDeliveryNoteResponseTransfer->getErpDeliveryNote();

        if ($erpDeliveryNoteTransfer === null || !$erpDeliveryNoteResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not update erp delivery note. %s', $erpDeliveryNoteResponseTransfer->getMessage()),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $erpDeliveryNoteTransfer,
            $erpDeliveryNoteTransfer->getIdErpDeliveryNote(),
        );
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idErpDeliveryNote): ApiItemTransfer
    {
        $erpDeliveryNoteTransfer = $this->getByIdErpDeliveryNote($idErpDeliveryNote);

        return $this->apiQueryContainer->createApiItem($erpDeliveryNoteTransfer, $idErpDeliveryNote);
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
            if (!isset($item[static::KEY_ID_ERP_DELIVERY_NOTE])) {
                continue;
            }

            $data[$index] = $this->getByIdErpDeliveryNote($item[static::KEY_ID_ERP_DELIVERY_NOTE])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function delete(int $idErpDeliveryNote): ApiItemTransfer
    {
        $this->getByIdErpDeliveryNote($idErpDeliveryNote);

        $this->erpDeliveryNoteFacade->deleteErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);

        return $this->apiQueryContainer->createApiItem(new ErpDeliveryNoteTransfer(), $idErpDeliveryNote);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    protected function getByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteTransfer
    {
        $erpDeliveryNoteTransfer = $this->erpDeliveryNoteFacade->findErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);

        if ($erpDeliveryNoteTransfer === null) {
            throw new EntityNotFoundException(
                sprintf('Could not find erp delivery note.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $erpDeliveryNoteTransfer;
    }
}
