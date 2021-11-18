<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Model;

use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class ErpInvoiceApi implements ErpInvoiceApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_ERP_INVOICE = 'id_erp_invoice';

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface
     */
    protected $erpInvoiceFacade;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface $erpInvoiceFacade
     * @param \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface $repository
     */
    public function __construct(
        ErpInvoiceApiToApiQueryContainerInterface $apiQueryContainer,
        ErpInvoiceApiToErpInvoiceFacadeInterface $erpInvoiceFacade,
        ErpInvoiceApiRepositoryInterface $repository
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->erpInvoiceFacade = $erpInvoiceFacade;
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
        $erpInvoiceTransfer = (new ErpInvoiceTransfer())->fromArray($apiDataTransfer->getData());
        $erpInvoiceResponseTransfer = $this->erpInvoiceFacade->createErpInvoice($erpInvoiceTransfer);
        $erpInvoiceTransfer = $erpInvoiceResponseTransfer->getErpInvoice();

        if ($erpInvoiceTransfer === null || !$erpInvoiceResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create erp invoice. %s', $erpInvoiceResponseTransfer->getMessage()),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $erpInvoiceTransfer,
            $erpInvoiceTransfer->getIdErpInvoice(),
        );
    }

    /**
     * @param int $idErpInvoice
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idErpInvoice, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $this->getByIdErpInvoice($idErpInvoice);

        $erpInvoiceTransfer = (new ErpInvoiceTransfer())
            ->fromArray($apiDataTransfer->getData(), true)
            ->setIdErpInvoice($idErpInvoice);

        $erpInvoiceResponseTransfer = $this->erpInvoiceFacade->updateErpInvoice($erpInvoiceTransfer);
        $erpInvoiceTransfer = $erpInvoiceResponseTransfer->getErpInvoice();

        if ($erpInvoiceTransfer === null || !$erpInvoiceResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not update erp invoice. %s', $erpInvoiceResponseTransfer->getMessage()),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $erpInvoiceTransfer,
            $erpInvoiceTransfer->getIdErpInvoice(),
        );
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idErpInvoice): ApiItemTransfer
    {
        $erpInvoiceTransfer = $this->getByIdErpInvoice($idErpInvoice);

        return $this->apiQueryContainer->createApiItem($erpInvoiceTransfer, $idErpInvoice);
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
            if (!isset($item[static::KEY_ID_ERP_INVOICE])) {
                continue;
            }

            $data[$index] = $this->getByIdErpInvoice($item[static::KEY_ID_ERP_INVOICE])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function delete(int $idErpInvoice): ApiItemTransfer
    {
        $this->getByIdErpInvoice($idErpInvoice);

        $this->erpInvoiceFacade->deleteErpInvoiceByIdErpInvoice($idErpInvoice);

        return $this->apiQueryContainer->createApiItem(new ErpInvoiceTransfer(), $idErpInvoice);
    }

    /**
     * @param int $idErpInvoice
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    protected function getByIdErpInvoice(int $idErpInvoice): ErpInvoiceTransfer
    {
        $erpInvoiceTransfer = $this->erpInvoiceFacade->findErpInvoiceByIdErpInvoice($idErpInvoice);

        if ($erpInvoiceTransfer === null) {
            throw new EntityNotFoundException(
                sprintf('Could not find erp invoice.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $erpInvoiceTransfer;
    }
}
