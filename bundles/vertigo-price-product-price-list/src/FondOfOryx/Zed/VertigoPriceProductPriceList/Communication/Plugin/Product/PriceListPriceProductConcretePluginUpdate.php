<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginUpdateInterface;

/**
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence\VertigoPriceProductPriceListRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacadeInterface getFacade()
 */
class PriceListPriceProductConcretePluginUpdate extends AbstractPlugin implements ProductConcretePluginUpdateInterface
{
     /**
      * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
      *
      * @return \Generated\Shared\Transfer\ProductConcreteTransfer
      */
    public function update(ProductConcreteTransfer $productConcreteTransfer): ProductConcreteTransfer
    {
        $this->getFacade()->requestMissingPriceProductPriceListByProductConcrete($productConcreteTransfer);

        return $productConcreteTransfer;
    }
}
