<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business;

use FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapter;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter\CreditMemoExporter;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter\CreditMemoExporterInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapper;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoDependencyProvider;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepository getRepository()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManager getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig getConfig()
 */
class JellyfishCreditMemoBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter\CreditMemoExporterInterface
     */
    public function createCreditMemoExporter(): CreditMemoExporterInterface
    {
        return new CreditMemoExporter(
            $this->createJellyfishCreditMemoMapper(),
            $this->getRepository(),
            $this->getConfig(),
            $this->getEntityManager(),
            $this->createCreditMemoAdapter(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface
     */
    protected function createCreditMemoAdapter(): CreditMemoAdapterInterface
    {
        return new CreditMemoAdapter(
            $this->getUtilEncodingService(),
            $this->createHttpClient(),
            $this->getConfig(),
            $this->getLogger(),
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

    /**
     * @return \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface
     */
    protected function createJellyfishCreditMemoMapper(): JellyfishCreditMemoMapperInterface
    {
        return new JellyfishCreditMemoMapper($this->getSalesFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): JellyfishCreditMemoToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(JellyfishCreditMemoDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface
     */
    protected function getSalesFacade(): JellyfishCreditMemoToSalesFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishCreditMemoDependencyProvider::FACADE_SALES);
    }
}
