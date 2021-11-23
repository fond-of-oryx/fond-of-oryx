<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestErpInvoicePageSearchCollectionResponseTransfer;

class ErpInvoiceMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\ErpInvoiceMapperInterface
     */
    protected $erpInvoiceMapper;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->erpInvoiceMapper = new ErpInvoiceMapper();
    }

    /**
     * @return void
     */
    public function testMapErpInvoiceResource(): void
    {
        $data = [
            'erp-invoices' => [
                0 => [
                    'erp_invoice_items' => [
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_invoice_total' => [
                        0 => ['value' => 1000],
                        2 => ['tax' => 190],
                    ],
                    'company_business_unit' => [
                        0 => ['name' => 'Default Unit'],
                    ],
                ],
            ],
        ];
        $transfer = $this->erpInvoiceMapper->mapErpInvoiceResource($data);

        $this->assertInstanceOf(RestErpInvoicePageSearchCollectionResponseTransfer::class, $transfer);
        $this->assertEquals('sku', $transfer->getErpInvoices()[0]->getItems()[0]->getSku());
    }
}
