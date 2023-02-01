<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;

class RestErpOrderPageSearchCollectionResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper\RestErpOrderPageSearchCollectionResponseMapperInterface
     */
    protected $restErpOrderPageSearchCollectionResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restErpOrderPageSearchCollectionResponseMapper = new RestErpOrderPageSearchCollectionResponseMapper();
    }

    /**
     * @return void
     */
    public function testMapErpOrderResource(): void
    {
        $data = [
            'erp-orders' => [
                0 => [
                    'items' => [
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_order_total' => [
                        0 => ['subtotal' => 1000],
                        1 => ['grandTotal' => 1990],
                        2 => ['taxTotal' => 190],
                    ],
                    'totals' => [
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
        $transfer = $this->restErpOrderPageSearchCollectionResponseMapper->fromSearchResult($data);

        static::assertEquals('sku', $transfer->getErpOrders()[0]->getItems()[0]->getSku());
        static::assertCount(count($data['erp-orders'][0]['items']), $transfer->getErpOrders()[0]->getItems());
    }
}
