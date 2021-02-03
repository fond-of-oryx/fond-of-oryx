<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Mapper;

interface ErpOrderPageSearchMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     * @param \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch $fooErpOrderPageSearch
     * @return \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearch
     */
    public function mapTransferToEntity(ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer, FooErpOrderPageSearch $fooErpOrderPageSearch): FooErpOrderPageSearch;
}
