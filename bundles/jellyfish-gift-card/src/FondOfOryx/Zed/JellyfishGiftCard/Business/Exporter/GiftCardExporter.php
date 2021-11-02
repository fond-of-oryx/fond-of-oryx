<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter;

use Exception;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class GiftCardExporter implements GiftCardExporterInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface
     */
    protected $jellyfishGiftCardRequestMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface
     */
    protected $jellyfishGiftCardDataWrapperMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface
     */
    protected $giftCardApiAdapter;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface $jellyfishGiftCardRequestMapper
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface $jellyfishGiftCardDataWrapperMapper
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface $giftCardApiAdapter
     */
    public function __construct(
        JellyfishGiftCardRequestMapperInterface $jellyfishGiftCardRequestMapper,
        JellyfishGiftCardDataWrapperMapperInterface $jellyfishGiftCardDataWrapperMapper,
        GiftCardApiAdapterInterface $giftCardApiAdapter
    ) {
        $this->jellyfishGiftCardRequestMapper = $jellyfishGiftCardRequestMapper;
        $this->jellyfishGiftCardDataWrapperMapper = $jellyfishGiftCardDataWrapperMapper;
        $this->giftCardApiAdapter = $giftCardApiAdapter;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @throws \Exception
     *
     * @return void
     */
    public function export(SpySalesOrderItem $orderItem, ReadOnlyArrayObject $data): void
    {
        $jellyfishGiftCardRequestTransfer = $this->jellyfishGiftCardRequestMapper->fromSalesOrderItem($orderItem);
        $jellyfishGiftCardDataWrapperTransfer = $this->jellyfishGiftCardDataWrapperMapper->fromJellyfishGiftCardRequest(
            $jellyfishGiftCardRequestTransfer,
        );

        if ($jellyfishGiftCardDataWrapperTransfer === null) {
            throw new Exception('Required post data is missing.');
        }

        $this->giftCardApiAdapter->post($jellyfishGiftCardDataWrapperTransfer);
    }
}
