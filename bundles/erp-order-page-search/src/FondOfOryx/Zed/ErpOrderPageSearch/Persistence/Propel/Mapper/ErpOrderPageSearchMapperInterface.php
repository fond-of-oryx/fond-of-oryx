<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch;

interface ErpOrderPageSearchMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     * @param \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch $fooErpOrderPageSearch
     *
     * @return \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch
     */
    public function mapTransferToEntity(
        ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer,
        FooErpOrderPageSearch $fooErpOrderPageSearch
    ): FooErpOrderPageSearch;
}
