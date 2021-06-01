<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage;

use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface;
use FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig;
use Generated\Shared\Transfer\CategoryCollectionTransfer;
use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;

class JellyfishCrossEngageReader implements JellyfishCrossEngageReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface
     */
    protected $productCategoryFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductFacadeInterface $productFacade
     * @param \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToProductCategoryFacadeInterface $productCategoryFacade
     * @param \FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client\JellyfishCrossEngageToLocaleFacadeInterface $localeFacade
     * @param \FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageConfig $config
     */
    public function __construct(
        JellyfishCrossEngageToProductFacadeInterface $productFacade,
        JellyfishCrossEngageToProductCategoryFacadeInterface $productCategoryFacade,
        JellyfishCrossEngageToLocaleFacadeInterface $localeFacade,
        JellyfishCrossEngageConfig $config
    ) {
        $this->productFacade = $productFacade;
        $this->productCategoryFacade = $productCategoryFacade;
        $this->config = $config;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return string|null
     */
    public function getGender(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): ?string
    {
        $productConcreteTransfer = $this->productFacade->getProductConcrete($jellyfishOrderItemTransfer->getSku());
        $attributes = $this->productFacade->getCombinedConcreteAttributes($productConcreteTransfer);

        return $attributes[$this->config->getGenderAttributeKey()] ?? null;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return string|null
     */
    public function getCategories(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): ?string
    {
        $localeTransfer = $this->localeFacade->getLocale($this->config->getDefaultLocaleName());
        $productConcreteTransfer = $this->productFacade->getProductConcrete($jellyfishOrderItemTransfer->getSku());

        $categoryCollectionTransfer = $this->productCategoryFacade->getCategoryTransferCollectionByIdProductAbstract(
            $productConcreteTransfer->getFkProductAbstract(),
            $localeTransfer
        );

        return $this->mapCategoryCollectionToString($categoryCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryCollectionTransfer $categoryCollectionTransfer
     *
     * @return string|null
     */
    protected function mapCategoryCollectionToString(CategoryCollectionTransfer $categoryCollectionTransfer): ?string
    {
        $categoryString = '';
        $categories = $categoryCollectionTransfer->getCategories();

        if ($categories->count() === 0) {
            return null;
        }

        foreach ($categories as $category) {
            $categoryString .= $this->mapCategoryToString($category);
        }

        return rtrim($categoryString, $this->config->getCategoriesSeparator());
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return string
     */
    protected function mapCategoryToString(CategoryTransfer $categoryTransfer): string
    {
        $categoryString = '';

        foreach ($categoryTransfer->getLocalizedAttributes() as $localizedCatAttribute) {
            $locale = $localizedCatAttribute->getLocale();

            if ($locale === null || $locale->getLocaleName() !== $this->config->getDefaultLocaleName()) {
                continue;
            }

            $categoryString .= $localizedCatAttribute->getName() . $this->config->getCategoriesSeparator();
        }

        return $categoryString;
    }
}
