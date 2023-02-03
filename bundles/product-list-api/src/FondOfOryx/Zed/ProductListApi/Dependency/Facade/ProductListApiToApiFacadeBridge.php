<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\Facade;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class ProductListApiToApiFacadeBridge implements ProductListApiToApiFacadeInterface
{
    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @param \Spryker\Zed\Api\Business\ApiFacadeInterface $apiFacade
     */
    public function __construct(ApiFacadeInterface $apiFacade)
    {
        $this->apiFacade = $apiFacade;
    }

    /**
     * @param array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer> $transfers
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $transfers): ApiCollectionTransfer
    {
        return $this->apiFacade->createApiCollection($transfers);
    }
}
