<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory getFactory()
 */
class GiftCardProductConnectorEntityManager extends AbstractEntityManager implements GiftCardProductConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param string $pattern
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer
     */
    public function createGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer,
        string $pattern
    ): SpyGiftCardProductAbstractConfigurationEntityTransfer {
        $entity = $this->getFactory()
            ->createSpyGiftCardProductAbstractConfigurationQuery()
            ->filterByCodePattern($pattern)
            ->findOneOrCreate();

        $entity->save();

        $entityTransfer = $this->getFactory()
            ->createGiftCardProductAbstractConfigurationMapper()
            ->mapEntityToTransfer($entity, new SpyGiftCardProductAbstractConfigurationEntityTransfer());

        return $entityTransfer
            ->addSpyGiftCardProductAbstractConfigurationLinks(
                $this->createGiftCardProductAbstractConfigurationLink($productAbstractTransfer, $entityTransfer)
            );
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer $entityTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer
     */
    protected function createGiftCardProductAbstractConfigurationLink(
        ProductAbstractTransfer $productAbstractTransfer,
        SpyGiftCardProductAbstractConfigurationEntityTransfer $entityTransfer
    ): SpyGiftCardProductAbstractConfigurationLinkEntityTransfer {
        $productAbstractEntity = $this->getFactory()->createProductAbstractQuery()
            ->findOneBySku($productAbstractTransfer->getSku());

        $entity = $this->getFactory()->createSpyGiftCardProductAbstractConfigurationLinkQuery()
            ->filterByFkGiftCardProductAbstractConfiguration($entityTransfer->getIdGiftCardProductAbstractConfiguration())
            ->filterByFkProductAbstract($productAbstractEntity->getIdProductAbstract())
            ->findOneOrCreate();

        $entity->save();

        return $this->getFactory()
            ->createGiftCardProductAbstractConfigurationLinkMapper()
            ->mapEntityToTransfer(
                $entity,
                new SpyGiftCardProductAbstractConfigurationLinkEntityTransfer()
            );
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     * @param int $value
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer
     */
    public function createGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer,
        int $value
    ): SpyGiftCardProductConfigurationEntityTransfer {
        $entity = $this->getFactory()
            ->createSpyGiftCardProductConfigurationQuery()
            ->filterByValue($value)
            ->findOneOrCreate();

        $entity->save();

        $entityTransfer = $this->getFactory()
            ->createGiftCardProductConfigurationMapper()
            ->mapEntityToTransfer($entity, new SpyGiftCardProductConfigurationEntityTransfer());

        return $entityTransfer
            ->addSpyGiftCardProductConfigurationLinks(
                $this->createGiftCardProductConfigurationLink($productConcreteTransfer, $entityTransfer)
            );
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     * @param \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer $entityTransfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer
     */
    protected function createGiftCardProductConfigurationLink(
        ProductConcreteTransfer $productConcreteTransfer,
        SpyGiftCardProductConfigurationEntityTransfer $entityTransfer
    ): SpyGiftCardProductConfigurationLinkEntityTransfer {
        $productEntity = $this->getFactory()->createProductQuery()
            ->findOneBySku($productConcreteTransfer->getSku());

        $entity = $this->getFactory()->createSpyGiftCardProductConfigurationLinkQuery()
            ->filterByFkGiftCardProductConfiguration($entityTransfer->getIdGiftCardProductConfiguration())
            ->filterByFkProduct($productEntity->getIdProduct())
            ->findOneOrCreate();

        $entity->save();

        return $this->getFactory()
            ->createGiftCardProductConfigurationLinkMapper()
            ->mapEntityToTransfer(
                $entity,
                new SpyGiftCardProductConfigurationLinkEntityTransfer()
            );
    }
}
