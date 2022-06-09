<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteMapperInterface
{
    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function mapIdToTransfer(int $id): QuoteTransfer;

    /**
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\QuoteTransfer>
     */
    public function mapIdsToTransfers(array $ids): array;
}
