<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner;

use FondOfOryx\Shared\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductDefaultCategoryAssignerConfig extends AbstractBundleConfig
{
    /**
     * @return int|null
     */
    public function getDefaultCategoryId(): ?int
    {
        $defaultCategoryId = $this->get(
            ProductDefaultCategoryAssignerConstants::DEFAULT_CATEGORY_ID,
            0,
        );

        if ($defaultCategoryId <= 0) {
            return null;
        }

        return $defaultCategoryId;
    }
}
