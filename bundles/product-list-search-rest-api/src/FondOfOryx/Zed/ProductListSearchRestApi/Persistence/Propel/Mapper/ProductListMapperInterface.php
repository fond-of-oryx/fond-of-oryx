<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductList;
use Propel\Runtime\Collection\ObjectCollection;


interface ProductListMapperInterface
{
    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductList $entity
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function mapEntityToTransfer(SpyProductList $entity): ProductListTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ProductList\Persistence\SpyCompanyUser> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\ProductListTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array;
}
