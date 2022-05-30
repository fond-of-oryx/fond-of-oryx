<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Orm\Zed\Quote\Persistence\Base\SpyQuote;
use Propel\Runtime\Collection\ObjectCollection;

interface QuoteMapperInterface
{
    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuote $entity
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function mapEntityToTransfer(SpyQuote $entity): QuoteTransfer;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Quote\Persistence\Base\SpyQuote> $entityCollection
     *
     * @return array<\Generated\Shared\Transfer\QuoteTransfer>
     */
    public function mapEntityCollectionToTransfers(ObjectCollection $entityCollection): array;
}
