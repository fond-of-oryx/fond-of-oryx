<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer;
use Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction;
use Propel\Runtime\Collection\ObjectCollection;

interface ProductPaymentRestrictionMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction> $fooProductAbstractPaymentRestrictionCollection
     *
     * @return array
     */
    public function mapEntityCollectionToGroupedPaymentNames(
        ObjectCollection $fooProductAbstractPaymentRestrictionCollection
    ): array;

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer $transfer
     * @param \Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction $entity
     *
     * @return \Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestriction
     */
    public function mapTransferToEntity(
        ProductAbstractPaymentRestrictionTransfer $transfer,
        FooProductAbstractPaymentRestriction $entity
    ): FooProductAbstractPaymentRestriction;
}
