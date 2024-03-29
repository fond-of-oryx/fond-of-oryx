<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\AbstractFullTextMapper;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapper;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\FullTextBoostedMapper;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\FullTextMapper;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisherInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher\ErpInvoicePageSearchUnpublisher;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher\ErpInvoicePageSearchUnpublisherInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepositoryInterface getRepository()
 */
class ErpInvoicePageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisherInterface
     */
    public function createErpInvoicePageSearchPublisher(): ErpInvoicePageSearchPublisherInterface
    {
        return new ErpInvoicePageSearchPublisher(
            $this->getEntityManager(),
            $this->getQueryContainer(),
            $this->getUtilEncodingService(),
            $this->createErpInvoicePageSearchDataMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher\ErpInvoicePageSearchUnpublisherInterface
     */
    public function createErpInvoicePageSearchUnPublisher(): ErpInvoicePageSearchUnpublisherInterface
    {
        return new ErpInvoicePageSearchUnpublisher(
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface
     */
    protected function createErpInvoicePageSearchDataMapper(): ErpInvoicePageSearchDataMapperInterface
    {
        return new ErpInvoicePageSearchDataMapper(
            $this->createFullTextMapper(),
            $this->createFullTextBoostedMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\AbstractFullTextMapper
     */
    protected function createFullTextMapper(): AbstractFullTextMapper
    {
        return new FullTextMapper(
            $this->getConfig(),
            $this->getFullTextExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\AbstractFullTextMapper
     */
    protected function createFullTextBoostedMapper(): AbstractFullTextMapper
    {
        return new FullTextBoostedMapper(
            $this->getConfig(),
            $this->getFullTextBoostedExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpInvoicePageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextBoostedExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER);
    }
}
