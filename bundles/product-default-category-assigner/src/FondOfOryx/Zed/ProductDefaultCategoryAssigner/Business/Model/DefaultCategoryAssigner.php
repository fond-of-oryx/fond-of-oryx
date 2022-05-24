<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model;

use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class DefaultCategoryAssigner implements DefaultCategoryAssignerInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected $productCategoryFacade;

    /**
     * @param \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig $config
     * @param \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface $productCategoryFacade
     */
    public function __construct(
        ProductDefaultCategoryAssignerConfig $config,
        ProductDefaultCategoryAssignerToProductCategoryFacadeInterface $productCategoryFacade
    ) {
        $this->config = $config;
        $this->productCategoryFacade = $productCategoryFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function assign(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        $defaultCategoryId = $this->config->getDefaultCategoryId();
        $productIdsToAssign = [$productAbstractTransfer->getIdProductAbstract()];

        $this->productCategoryFacade->createProductCategoryMappings($defaultCategoryId, $productIdsToAssign);

        return $productAbstractTransfer;
    }
}
