<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class CompanyBusinessUnitApiToApiQueryContainerBridge implements CompanyBusinessUnitApiToApiQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Api\Persistence\ApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @param \Spryker\Zed\Api\Persistence\ApiQueryContainerInterface $apiQueryContainer
     */
    public function __construct(ApiQueryContainerInterface $apiQueryContainer)
    {
        $this->apiQueryContainer = $apiQueryContainer;
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $data): ApiCollectionTransfer
    {
        return $this->apiQueryContainer->createApiCollection($data);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|array $data
     * @param int|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem($data, ?int $id = null): ApiItemTransfer
    {
        return $this->apiQueryContainer->createApiItem($data, $id);
    }
}
