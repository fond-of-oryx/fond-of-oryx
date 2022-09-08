<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business;

use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapter;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapper;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapperInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequester;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequesterInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service\VertigoPriceProductPriceListToUtilEncodingServiceInterface;
use FondOfOryx\Zed\VertigoPriceProductPriceList\VertigoPriceProductPriceListDependencyProvider;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\VertigoPriceProductPriceListConfig getConfig()
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface getRepository()
 */
class VertigoPriceProductPriceListBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Requester\PriceProductPriceListRequesterInterface
     */
    public function createPriceProductPriceListRequester(): PriceProductPriceListRequesterInterface
    {
        return new PriceProductPriceListRequester(
            $this->createVertigoPriceApiAdapter(),
            $this->getRepository(),
            $this->getProductFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter\VertigoPriceApiAdapterInterface
     */
    protected function createVertigoPriceApiAdapter(): VertigoPriceApiAdapterInterface
    {
        return new VertigoPriceApiAdapter(
            $this->createHttpClient(),
            $this->createVertigoPriceApiResponseMapper(),
            $this->getUtilEncodingService(),
            $this->getLogger(),
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): HttpClientInterface
    {
        return new Client($this->getConfig()->getHttpClientConfig());
    }

    /**
     * @return \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapperInterface
     */
    protected function createVertigoPriceApiResponseMapper(): VertigoPriceApiResponseMapperInterface
    {
        return new VertigoPriceApiResponseMapper();
    }

    /**
     * @return \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Facade\VertigoPriceProductPriceListToProductFacadeInterface
     */
    protected function getProductFacade(): VertigoPriceProductPriceListToProductFacadeInterface
    {
        return $this->getProvidedDependency(VertigoPriceProductPriceListDependencyProvider::FACADE_PRODUCT);
    }

    /**
     * @return \FondOfOryx\Zed\VertigoPriceProductPriceList\Dependency\Service\VertigoPriceProductPriceListToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): VertigoPriceProductPriceListToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(VertigoPriceProductPriceListDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
