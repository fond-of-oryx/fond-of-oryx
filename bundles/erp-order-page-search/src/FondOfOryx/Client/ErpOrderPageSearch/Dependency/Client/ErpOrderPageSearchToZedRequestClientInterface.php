<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ErpOrderPageSearchToZedRequestClientInterface
{
    /**
     * Specification:
     * - Prepare and make the call to Zed.
     *
     * Third argument has changed from int to array. BC compatibility method will
     * convert the previous accepted integer to `['timeout => $timeoutInSeconds]`
     *
     * @api
     *
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param array|null $requestOptions Deprecated: Do not use "int" anymore, please use an array for requestOptions.
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function call(string $url, TransferInterface $object, ?array $requestOptions = null): TransferInterface;
}
