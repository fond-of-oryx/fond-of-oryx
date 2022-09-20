<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductList;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * @codeCoverageIgnore
 */
class ProductListMapper implements ProductListMapperInterface
{
    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductList $entity
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function mapEntityToTransfer(SpyProductList $entity): ProductListTransfer
    {
        return (new ProductListTransfer())
            ->fromArray($entity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ProductList\Persistence\SpyProductList> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\ProductListTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity);
        }

        return $transfers;
    }
}
