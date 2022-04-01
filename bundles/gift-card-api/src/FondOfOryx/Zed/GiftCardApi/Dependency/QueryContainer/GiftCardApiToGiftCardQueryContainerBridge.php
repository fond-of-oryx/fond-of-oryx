<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery;
use Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface;

class GiftCardApiToGiftCardQueryContainerBridge implements GiftCardApiToGiftCardQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Spryker\Zed\GiftCard\Persistence\GiftCardQueryContainerInterface $queryContainer
     */
    public function __construct(GiftCardQueryContainerInterface $queryContainer)
    {
        $this->queryContainer = $queryContainer;
    }

    /**
     * @param string $code
     *
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery
     */
    public function queryGiftCardByCode(string $code): SpyGiftCardQuery
    {
        return $this->queryContainer->queryGiftCardByCode($code);
    }

    /**
     * @return \Orm\Zed\GiftCard\Persistence\SpyGiftCardQuery
     */
    public function getGiftCardQuery(): SpyGiftCardQuery
    {
        return $this->queryContainer->queryGiftCards();
    }
}
