<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Persistence;

interface ProductListsRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return int|null
     */
    public function getIdProductListByUuid(string $uuid): ?int;
}
