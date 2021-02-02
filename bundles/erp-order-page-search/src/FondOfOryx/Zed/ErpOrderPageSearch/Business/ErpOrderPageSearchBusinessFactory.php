<?php
namespace FondOfOryx\Zed\ErpOrderPageSearch\Business;

use FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchDataMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchPublisher;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchPublisherInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchUnpublisher;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchUnpublisherInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Persistence\ConditionalAvailabilityPageSearchEntityManagerInterface getEntityManager()
 */
class ErpOrderPageSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchPublisherInterface
     */
    public function createErpOrderPageSearchPublisher(): ErpOrderPageSearchPublisherInterface
    {
        return new ErpOrderPageSearchPublisher(
            $this->getEntityManager(),
            $this->getUtilEncodingService(),
            $this->createErpOrderPageSearchDataMapper()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchUnpublisherInterface
     */
    public function createErpOrderPageSearchUnPublisher(): ErpOrderPageSearchUnpublisherInterface
    {
        return new ErpOrderPageSearchUnpublisher(
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Business\Model\ConditionalAvailabilityPeriodPageSearchDataMapperInterface
     */
    protected function createErpOrderPageSearchDataMapper(): ErpOrderPageSearchDataMapperInterface
    {
        return new ErpOrderPageSearchDataMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ConditionalAvailabilityPageSearch\Dependency\Service\ConditionalAvailabilityPageSearchToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): ErpOrderPageSearchToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
