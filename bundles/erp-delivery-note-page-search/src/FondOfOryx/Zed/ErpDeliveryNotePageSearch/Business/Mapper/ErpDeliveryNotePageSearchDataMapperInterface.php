<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

interface ErpDeliveryNotePageSearchDataMapperInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function mapErpDeliveryNoteDataToSearchData(array $data): array;
}
