<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginCreateInterface;

/**
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacadeInterface getFacade()
 */
class PriceListPriceProductConcretePluginCreate extends AbstractPlugin implements ProductConcretePluginCreateInterface
{
     /**
      * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
      *
      * @return \Generated\Shared\Transfer\ProductConcreteTransfer
      */
    public function create(ProductConcreteTransfer $productConcreteTransfer): ProductConcreteTransfer
    {
        $this->getFacade()->requestMissingPriceProductPriceListByProductConcrete($productConcreteTransfer);

        return $productConcreteTransfer;
    }
}
