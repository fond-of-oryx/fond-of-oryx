<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface;
use FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferOrder;
use FondOfOryx\Zed\JellyfishBuffer\Business\Export\DataExportInterface;
use FondOfOryx\Zed\JellyfishBuffer\Business\Export\OrderExport;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig getConfig()
 */
class JellyfishBufferBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\JellyfishBuffer\Business\Buffer\JellyfishBufferInterface
     */
    public function createJellyfishBufferOrder(): JellyfishBufferInterface
    {
        return new JellyfishBufferOrder(
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishBuffer\Business\Export\DataExportInterface
     */
    public function createOrderExport(): DataExportInterface
    {
        return new OrderExport(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getLogger(),
            $this->createHttpClient(),
            $this->getConfig()
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): HttpClientInterface
    {
        return new HttpClient([
            'base_uri' => $this->getConfig()->getBaseUri(),
            'timeout' => $this->getConfig()->getTimeout(),
        ]);
    }
}
