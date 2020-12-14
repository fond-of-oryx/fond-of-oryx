<?php

namespace FondOfOryx\Client\CustomerStatistic\Zed;

use FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticZedStub implements CustomerStatisticZedStubInterface
{
    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CustomerStatisticToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function incrementLoginCount(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer $customerStatisticResponseTransfer */
        $customerStatisticResponseTransfer = $this->zedRequestClient->call(
            '/customer-statistic/gateway/increment-login-count',
            $customerTransfer
        );

        return $customerStatisticResponseTransfer;
    }
}
