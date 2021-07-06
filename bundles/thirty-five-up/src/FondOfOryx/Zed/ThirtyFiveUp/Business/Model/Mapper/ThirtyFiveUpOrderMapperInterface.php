<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;

interface ThirtyFiveUpOrderMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|null
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ?ThirtyFiveUpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function fromSavedOrder(SaveOrderTransfer $saveOrderTransfer, ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer;

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function fromEntity(FooThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer;
}
