<?php

namespace FondOfOryx\Service\Trbo;

use FondOfOryx\Service\Trbo\Api\TrboApi;
use FondOfOryx\Service\Trbo\Api\TrboApiConfiguration;
use FondOfOryx\Service\Trbo\Api\TrboApiConfigurationInterface;
use FondOfOryx\Service\Trbo\Api\TrboApiInterface;
use FondOfOryx\Service\Trbo\Mapper\TrboMapper;
use FondOfOryx\Service\Trbo\Mapper\TrboMapperInterface;
use GuzzleHttp\ClientInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Shared\Log\LoggerTrait;

/**
 * @method \FondOfOryx\Service\Trbo\TrboConfig getConfig()
 */
class TrboServiceFactory extends AbstractServiceFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Service\Trbo\Api\TrboApiInterface
     */
    public function createTrboApi(): TrboApiInterface
    {
        return new TrboApi($this->getLogger(), $this->getHttpClient(), $this->createTrboApiConfiguration(), $this->createTrboMapper());
    }

    /**
     * @return \FondOfOryx\Service\Trbo\Api\TrboApiConfigurationInterface
     */
    protected function createTrboApiConfiguration(): TrboApiConfigurationInterface
    {
        return new TrboApiConfiguration($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Service\Trbo\Mapper\TrboMapperInterface
     */
    protected function createTrboMapper(): TrboMapperInterface
    {
        return new TrboMapper();
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function getHttpClient(): ClientInterface
    {
        return $this->getProvidedDependency(TrboDependencyProvider::HTTP_CLIENT);
    }
}
