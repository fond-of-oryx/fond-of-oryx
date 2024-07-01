<?php

namespace FondOfOryx\Zed\EasyApi\Business;

use FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapper;
use FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapperInterface;
use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface;
use FondOfOryx\Zed\EasyApi\EasyApiDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\EasyApi\EasyApiConfig getConfig()
 */
class EasyApiBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\EasyApi\Business\Model\ApiWrapperInterface
     */
    public function createApiWrapper(): ApiWrapperInterface
    {
        return new ApiWrapper(
            $this->getGuzzleClient(),
            $this->getConfig(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientInterface
     */
    protected function getGuzzleClient(): EasyApiToGuzzleClientInterface
    {
        return $this->getProvidedDependency(EasyApiDependencyProvider::CLIENT_GUZZLE);
    }
}
