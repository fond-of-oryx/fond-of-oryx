<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business;

use FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReader;
use FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReaderInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig getConfig()
 */
class JellyfishCrossEngageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage\JellyfishCrossEngageReaderInterface
     */
    public function createJellyfishCrossEngageReader(): JellyfishCrossEngageReaderInterface
    {
        return new JellyfishCrossEngageReader(
            $this->getProductFacade(),
            $this->getProductCategoryFacade(),
            $this->getLocaleFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface
     */
    protected function getProductFacade(): JellyfishCrossEngageToProductFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishCrossEngageDependencyProvider::PRODUCT_FACADE);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface
     */
    protected function getProductCategoryFacade(): JellyfishCrossEngageToProductCategoryFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishCrossEngageDependencyProvider::PRODUCT_CATEGORY_FACADE);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface
     */
    protected function getLocaleFacade(): JellyfishCrossEngageToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishCrossEngageDependencyProvider::LOCALE_FACADE);
    }
}
