<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;

/**
 * @codeCoverageIgnore
 */
class QuoteMapper implements QuoteMapperInterface
{
    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function mapIdToTransfer(int $id): QuoteTransfer
    {
        return (new QuoteTransfer())
            ->setIdQuote($id);
    }

    /**
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\QuoteTransfer>
     */
    public function mapIdsToTransfers(array $ids): array
    {
        $transfers = [];

        foreach ($ids as $id) {
            $transfers[] = $this->mapIdToTransfer($id);
        }

        return $transfers;
    }
}
