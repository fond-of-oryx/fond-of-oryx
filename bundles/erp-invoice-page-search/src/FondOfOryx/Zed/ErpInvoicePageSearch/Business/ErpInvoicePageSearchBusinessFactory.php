<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business;

use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapper;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface;
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
        return new ErpInvoicePageSearchDataMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpInvoicePageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpInvoicePageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
