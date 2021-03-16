<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler;

use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpOrderHandler implements ThirtyFiveUpOrderHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface
     */
    protected $orderWriter;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface
     */
    protected $orderMapper;

    /**
     * @param \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface $orderMapper
     * @param \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface $writer
     */
    public function __construct(ThirtyFiveUpOrderMapperInterface $orderMapper, ThirtyFiveUpOrderWriterInterface $writer)
    {
        $this->orderMapper = $orderMapper;
        $this->orderWriter = $writer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function handleFromQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $mappedData = $this->orderMapper->fromQuote($quoteTransfer);
        if ($mappedData !== null) {
            $quoteTransfer->setThirtyFiveUpOrder($this->orderWriter->create($mappedData));
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function handleFromSavedOrder(SaveOrderTransfer $saveOrderTransfer, ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer): ThirtyFiveUpOrderTransfer
    {
        $thirtyFiveUpOrderTransfer = $this->orderMapper->fromSavedOrder($saveOrderTransfer, $thirtyFiveUpOrderTransfer);

        return $this->orderWriter->update($thirtyFiveUpOrderTransfer);
    }
}
