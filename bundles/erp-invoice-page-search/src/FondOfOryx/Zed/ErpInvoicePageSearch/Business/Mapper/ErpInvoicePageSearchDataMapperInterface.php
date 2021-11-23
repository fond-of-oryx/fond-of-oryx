<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

interface ErpInvoicePageSearchDataMapperInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpInvoiceDataToSearchData(array $data): array;
}
