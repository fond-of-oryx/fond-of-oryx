<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestErpOrderPageSearchCollectionResponseTransfer;

class ErpOrderMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\ErpOrderMapperInterface
     */
    protected $erpOrderMapper;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->erpOrderMapper = new ErpOrderMapper();
    }

    /**
     * @return void
     */
    public function testMapErpOrderResource(): void
    {
        $data = [
            'erp-orders' => [
                0 => [
                    'erp_order_items' => [
                        0 => ['id_erp_order_item' => 1],
                    ],
                ],
            ],
        ];
        $transfer = $this->erpOrderMapper->mapErpOrderResource($data);

        $this->assertInstanceOf(RestErpOrderPageSearchCollectionResponseTransfer::class, $transfer);
        $this->assertEquals(1, $transfer->getErpOrders()[0]->getOrderItems()[0]->getIdErpOrderItem());
    }
}
