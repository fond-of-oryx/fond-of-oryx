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
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_order_total' => [
                        0 => ['subtotal' => 1000],
                        1 => ['grandTotal' => 1990],
                        2 => ['taxTotal' => 190],
                    ],
                    'company_business_unit' => [
                        0 => ['name' => 'Default Unit'],
                    ],
                ],
            ],
        ];
        $transfer = $this->erpOrderMapper->mapErpOrderResource($data);

        $this->assertInstanceOf(RestErpOrderPageSearchCollectionResponseTransfer::class, $transfer);
        $this->assertEquals('sku', $transfer->getErpOrders()[0]->getItems()[0]->getSku());
    }
}
