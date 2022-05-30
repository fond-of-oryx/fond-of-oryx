<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Orm\Zed\Quote\Persistence\Base\SpyQuote;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * @codeCoverageIgnore
 */
class QuoteMapper implements QuoteMapperInterface
{
    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuote $entity
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function mapEntityToTransfer(SpyQuote $entity): QuoteTransfer
    {
        return (new QuoteTransfer())
            ->fromArray($entity->toArray(), true);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Quote\Persistence\Base\SpyQuote> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\QuoteTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array
    {
        $transfers = [];

        foreach ($entityCollection as $entity) {
            $transfers[] = $this->mapEntityToTransfer($entity);
        }

        return $transfers;
    }
}
