<?php

namespace FondOfOryx\Zed\CompanyApi\Dependency\Facade;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class CompanyApiToApiFacadeBridge implements CompanyApiToApiFacadeInterface
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
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|null $transfer
     * @param string|null $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createApiItem(?AbstractTransfer $transfer = null, ?string $id = null): ApiItemTransfer
    {
        return $this->apiFacade->createApiItem($transfer, $id);
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
