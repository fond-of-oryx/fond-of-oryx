<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface;
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
        return new ErpOrderPageSearchDataMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpOrderPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
