<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence;

use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLinkQuery;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorPersistenceFactory getFactory()
 */
class GiftCardProductConnectorEntityManager extends AbstractEntityManager implements GiftCardProductConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     * @param string $pattern
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
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

        $giftCardProductAbstractConfigurationTransfer = $this->getFactory()
            ->createGiftCardProductAbstractConfigurationMapper()
            ->mapEntityToTransfer($entity, new SpyGiftCardProductAbstractConfigurationEntityTransfer());

        $productAbstractEntity = $this->getFactory()->createProductAbstractQuery()
            ->findOneBySku($productAbstractTransfer->getSku());

        $linkEntity = $this->getFactory()->createSpyGiftCardProductAbstractConfigurationLinkQuery()
            ->filterByFkGiftCardProductAbstractConfiguration($entity->getIdGiftCardProductAbstractConfiguration())
            ->filterByFkProductAbstract($productAbstractEntity->getIdProductAbstract())
            ->findOneOrCreate();

        $linkEntity->save();

        $giftCardProductAbstractConfigurationLinkTransfer = $this->getFactory()
            ->createGiftCardProductAbstractConfigurationLinkMapper()
            ->mapEntityToTransfer(
                $linkEntity,
                new SpyGiftCardProductAbstractConfigurationLinkEntityTransfer()
            );

        $giftCardProductAbstractConfigurationTransfer
            ->addSpyGiftCardProductAbstractConfigurationLinks($giftCardProductAbstractConfigurationLinkTransfer);

        return $giftCardProductAbstractConfigurationTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     * @param int $value
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
    }
}
