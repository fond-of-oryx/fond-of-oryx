<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class ProductListApiToApiQueryContainerBridge implements ProductListApiToApiQueryContainerInterface
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
}
