<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CartCodeTypeTransfer;
use Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer;
use Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction;
use Propel\Runtime\Collection\ObjectCollection;

class ProductAbstractCartCodeTypeRestrictionMapper implements ProductAbstractCartCodeTypeRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\CartCodeTypeTransfer>
     */
    public function mapEntityCollectionToCartCodeTypeTransfers(
        ObjectCollection $entityCollection
    ): array {
        $cartCodeTypeTransfers = [];

        foreach ($entityCollection as $fooProductAbstractCartCodeTypeRestriction) {
            $fooCartCodeType = $fooProductAbstractCartCodeTypeRestriction->getCartCodeType();
            $cartCodeTypeTransfers[] = (new CartCodeTypeTransfer())->fromArray($fooCartCodeType->toArray());
        }

        return $cartCodeTypeTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction $entity
     *
     * @return \Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractCartCodeTypeRestrictionTransfer $transfer,
        FooProductAbstractCartCodeTypeRestriction $entity
    ): FooProductAbstractCartCodeTypeRestriction {
        $entity->fromArray($transfer->toArray());

        return $entity->setFkCartCodeType($transfer->getIdCartCodeType())
            ->setFkProductAbstract($transfer->getIdProductAbstract());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestriction[] $entityCollection
     * @param string|null $virtualColumnForGrouping
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedCartCodeTypeNames(
        ObjectCollection $entityCollection,
        ?string $virtualColumnForGrouping = null
    ): array {
        $groupedCartCodeTypeIds = [];

        foreach ($entityCollection as $fooProductAbstractCartCodeTypeRestriction) {
            $key = $fooProductAbstractCartCodeTypeRestriction->getFkProductAbstract();
            $cartCodeType = $fooProductAbstractCartCodeTypeRestriction->getCartCodeType();

            if ($virtualColumnForGrouping !== null) {
                $key = $fooProductAbstractCartCodeTypeRestriction->getVirtualColumn($virtualColumnForGrouping);
            }

            if (!isset($groupedCartCodeTypeIds[$key])) {
                $groupedCartCodeTypeIds[$key] = [];
            }

            $groupedCartCodeTypeIds[$key][] = $cartCodeType->getName();
        }

        return $groupedCartCodeTypeIds;
    }
}
