<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

interface ErpOrderPageSearchDataMapperInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpOrderDataToSearchData(array $data): array;
}
