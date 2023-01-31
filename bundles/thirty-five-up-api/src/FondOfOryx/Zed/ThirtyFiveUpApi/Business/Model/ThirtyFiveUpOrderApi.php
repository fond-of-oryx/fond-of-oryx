<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model;

use Exception;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class ThirtyFiveUpOrderApi implements ThirtyFiveUpOrderApiInterface
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
     */
    protected $thirtyFiveUpFacade;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
     * @param \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface $repository
     */
    public function __construct(
        ThirtyFiveUpApiToApiFacadeInterface $apiFacade,
        ThirtyFiveUpApiToThirtyFiveUpFacadeInterface $thirtyFiveUpFacade,
        ThirtyFiveUpApiRepositoryInterface $repository
    ) {
        $this->apiFacade = $apiFacade;
        $this->thirtyFiveUpFacade = $thirtyFiveUpFacade;
        $this->repository = $repository;
    }

    /**
     * @param int $idThirtyFiveUpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idThirtyFiveUpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $thirtyFiveUpOrderTransfer = $this->createThirtyFiveUpOrderTransfer($apiDataTransfer->getData());

        try {
            $thirtyFiveUpOrderTransfer = $this->thirtyFiveUpFacade->updateThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);
        } catch (Exception $exception) {
            throw new EntityNotSavedException(
                sprintf('Could not update thirty five up order with id %s', $idThirtyFiveUpOrder),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
                $exception,
            );
        }

        return $this->apiFacade->createApiItem(
            $thirtyFiveUpOrderTransfer,
            (string)$thirtyFiveUpOrderTransfer->getId(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->repository->find($apiRequestTransfer);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    protected function createThirtyFiveUpOrderTransfer(array $data): ThirtyFiveUpOrderTransfer
    {
        return (new ThirtyFiveUpOrderTransfer())->fromArray($data, true);
    }
}
