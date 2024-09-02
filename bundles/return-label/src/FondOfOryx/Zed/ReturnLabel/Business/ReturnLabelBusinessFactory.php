<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGenerator;
use FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface;
use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig getConfig()
 */
class ReturnLabelBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface
     */
    public function createReturnLabelGenerator(): ReturnLabelGeneratorInterface
    {
        return new ReturnLabelGenerator(
            $this->createReturnLabelAdapter(),
            $this->getConfig(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface
     */
    protected function createReturnLabelAdapter(): ReturnLabelAdapterInterface
    {
        return new ReturnLabelAdapter(
            $this->createHttpClient(),
            $this->getConfig(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): HttpClientInterface
    {
        return new HttpClient();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ReturnLabelToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ReturnLabelDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
