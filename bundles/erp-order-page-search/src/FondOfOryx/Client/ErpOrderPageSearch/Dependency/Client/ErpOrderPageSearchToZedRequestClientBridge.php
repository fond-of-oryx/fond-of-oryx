<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class ErpOrderPageSearchToZedRequestClientBridge implements ErpOrderPageSearchToZedRequestClientInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $client;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClientInterface $client
     */
    public function __construct(ZedRequestClientInterface $client)
    {
        $this->client = $client;
    }

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
    public function call(string $url, TransferInterface $object, ?array $requestOptions = null): TransferInterface
    {
        return $this->client->call($url, $object, $requestOptions);
    }
}
