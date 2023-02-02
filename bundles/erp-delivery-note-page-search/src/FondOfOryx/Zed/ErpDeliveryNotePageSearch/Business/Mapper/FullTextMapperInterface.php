<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

interface FullTextMapperInterface
{
    /**
     * @param array $data
     *
     * @return array<string>
     */
    public function fromData(array $data): array;
}
