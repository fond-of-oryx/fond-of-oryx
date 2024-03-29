<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\FullTextBoostedMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\FullTextMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisherInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher\ErpOrderPageSearchUnpublisher;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher\ErpOrderPageSearchUnpublisherInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepositoryInterface getRepository()
 */
class ErpOrderPageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisherInterface
     */
    public function createErpOrderPageSearchPublisher(): ErpOrderPageSearchPublisherInterface
    {
        return new ErpOrderPageSearchPublisher(
            $this->getEntityManager(),
            $this->getQueryContainer(),
            $this->getUtilEncodingService(),
            $this->createErpOrderPageSearchDataMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher\ErpOrderPageSearchUnpublisherInterface
     */
    public function createErpOrderPageSearchUnPublisher(): ErpOrderPageSearchUnpublisherInterface
    {
        return new ErpOrderPageSearchUnpublisher(
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface
     */
    protected function createErpOrderPageSearchDataMapper(): ErpOrderPageSearchDataMapperInterface
    {
        return new ErpOrderPageSearchDataMapper(
            $this->createFullTextMapper(),
            $this->createFullTextBoostedMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper
     */
    protected function createFullTextMapper(): AbstractFullTextMapper
    {
        return new FullTextMapper(
            $this->getConfig(),
            $this->getFullTextExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\AbstractFullTextMapper
     */
    protected function createFullTextBoostedMapper(): AbstractFullTextMapper
    {
        return new FullTextBoostedMapper(
            $this->getConfig(),
            $this->getFullTextBoostedExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpOrderPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextBoostedExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER);
    }
}
