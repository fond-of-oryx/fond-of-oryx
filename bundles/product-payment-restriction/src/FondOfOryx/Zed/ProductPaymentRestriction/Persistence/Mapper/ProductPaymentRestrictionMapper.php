<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper;

use Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer;
use Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction;
use Propel\Runtime\Collection\ObjectCollection;

class ProductPaymentRestrictionMapper implements ProductPaymentRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction> $fooProductAbstractPaymentRestrictionCollection
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedPaymentNames(
        ObjectCollection $fooProductAbstractPaymentRestrictionCollection
    ): array {
        $groupedPaymentIds = [];

        foreach ($fooProductAbstractPaymentRestrictionCollection as $fooProductAbstractPaymentRestriction) {
            $key = $fooProductAbstractPaymentRestriction->getFkProductAbstract();
            $paymentMethod = $fooProductAbstractPaymentRestriction->getPaymentMethod();

            if (!isset($groupedPaymentIds[$key])) {
                $groupedPaymentIds[$key] = [];
            }

            $groupedPaymentIds[$key][] = $paymentMethod->getPaymentMethodKey();
        }

        return $groupedPaymentIds;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction $entity
     *
     * @return \Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractPaymentRestrictionTransfer $transfer,
        FooProductAbstractPaymentRestriction $entity
    ): FooProductAbstractPaymentRestriction {
        $entity->fromArray($transfer->toArray());

        return $entity->setFkPaymentMethod($transfer->getIdPaymentMethod())
            ->setFkProductAbstract($transfer->getIdProductAbstract());
    }
}
