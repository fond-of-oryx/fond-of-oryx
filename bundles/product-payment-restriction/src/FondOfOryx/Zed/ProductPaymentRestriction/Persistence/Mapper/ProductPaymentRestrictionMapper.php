<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper;

use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer;
use Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction;
use Propel\Runtime\Collection\ObjectCollection;

class ProductPaymentRestrictionMapper implements ProductPaymentRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<int, \Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction> $fooProductAbstractPaymentRestrictionCollection
     *
     * @return array<\Generated\Shared\Transfer\PaymentMethodTransfer>
     */
    public function mapEntityCollectionToPaymentMethodTransfers(
        ObjectCollection $fooProductAbstractPaymentRestrictionCollection
    ): array {
        $paymentMethodTransfers = [];

        foreach ($fooProductAbstractPaymentRestrictionCollection as $fooProductAbstractPaymentRestriction) {
            $spyPaymentMethod = $fooProductAbstractPaymentRestriction->getPaymentMethod();
            $paymentMethodTransfers[] = (new PaymentMethodTransfer())->fromArray($spyPaymentMethod->toArray(), true);
        }

        return $paymentMethodTransfers;
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
