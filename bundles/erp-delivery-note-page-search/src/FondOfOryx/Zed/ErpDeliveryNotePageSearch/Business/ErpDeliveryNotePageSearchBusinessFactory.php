<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\AbstractFullTextMapper;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapper;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\FullTextBoostedMapper;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\FullTextMapper;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisherInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisherInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepositoryInterface getRepository()
 */
class ErpDeliveryNotePageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisherInterface
     */
    public function createErpDeliveryNotePageSearchPublisher(): ErpDeliveryNotePageSearchPublisherInterface
    {
        return new ErpDeliveryNotePageSearchPublisher(
            $this->getEntityManager(),
            $this->getQueryContainer(),
            $this->getUtilEncodingService(),
            $this->createErpDeliveryNotePageSearchDataMapper(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher\ErpDeliveryNotePageSearchUnpublisherInterface
     */
    public function createErpDeliveryNotePageSearchUnPublisher(): ErpDeliveryNotePageSearchUnpublisherInterface
    {
        return new ErpDeliveryNotePageSearchUnpublisher(
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface
     */
    protected function createErpDeliveryNotePageSearchDataMapper(): ErpDeliveryNotePageSearchDataMapperInterface
    {
        return new ErpDeliveryNotePageSearchDataMapper(
            $this->createFullTextMapper(),
            $this->createFullTextBoostedMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\AbstractFullTextMapper
     */
    protected function createFullTextMapper(): AbstractFullTextMapper
    {
        return new FullTextMapper(
            $this->getConfig(),
            $this->getFullTextExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\AbstractFullTextMapper
     */
    protected function createFullTextBoostedMapper(): AbstractFullTextMapper
    {
        return new FullTextBoostedMapper(
            $this->getConfig(),
            $this->getFullTextBoostedExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_FULL_TEXT_EXPANDER);
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextBoostedExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER);
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
