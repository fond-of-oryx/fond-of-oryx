<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Model;

use FondOfOryx\Zed\CreditMemoApi\Business\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeInterface;
use FondOfOryx\Zed\CreditMemoApi\Dependency\QueryContainer\CreditMemoApiToApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CreditMemoApi implements CreditMemoApiInterface
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoApi\Dependency\QueryContainer\CreditMemoApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeInterface
     */
    protected $creditMemoFacade;

    /**
     * @var \FondOfOryx\Zed\CreditMemoApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @param \FondOfOryx\Zed\CreditMemoApi\Dependency\QueryContainer\CreditMemoApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfOryx\Zed\CreditMemoApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfOryx\Zed\CreditMemoApi\Dependency\Facade\CreditMemoApiToCreditMemoFacadeInterface $creditMemoFacade
     */
    public function __construct(
        CreditMemoApiToApiQueryContainerInterface $apiQueryContainer,
        TransferMapperInterface $transferMapper,
        CreditMemoApiToCreditMemoFacadeInterface $creditMemoFacade
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->transferMapper = $transferMapper;
        $this->creditMemoFacade = $creditMemoFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = $apiDataTransfer->getData();

        $creditMemoTransfer = $this->transferMapper->toTransfer($data);

        $creditMemoResponseTransfer = $this->creditMemoFacade->createCreditMemo(
            $creditMemoTransfer
        );

        $creditMemoTransfer = $creditMemoResponseTransfer->getCreditMemoTransfer();

        if ($creditMemoTransfer === null || $creditMemoResponseTransfer->getIsSuccess() === false) {
            throw new EntityNotSavedException(
                'Could not save credit memo.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $creditMemoTransfer,
            $creditMemoTransfer->getIdCreditMemo()
        );
    }
}
