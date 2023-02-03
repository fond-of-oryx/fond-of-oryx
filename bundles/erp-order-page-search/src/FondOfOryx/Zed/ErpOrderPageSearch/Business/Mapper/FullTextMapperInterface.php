<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

interface FullTextMapperInterface
{
    /**
     * @param array $data
     *
     * @return array<string>
     */
    public function fromData(array $data): array;
}
