<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery;

interface GiftCardApiToGiftCardQueryContainerInterface
{
    /**
     * @param string $code
     *
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery
     */
    public function queryGiftCardByCode(string $code): SpyGiftCardQuery;

    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery
     */
    public function getGiftCardQuery(): SpyGiftCardQuery;
}
