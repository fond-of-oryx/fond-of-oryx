<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;

class RestErpInvoicePageSearchCollectionResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Model\Mapper\RestErpInvoicePageSearchCollectionResponseMapperInterface
     */
    protected $restErpInvoicePageSearchCollectionResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restErpInvoicePageSearchCollectionResponseMapper = new RestErpInvoicePageSearchCollectionResponseMapper();
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
                    'erp_invoice_expenses' => [
                        0 => ['name' => 'name'],
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

        $transfer = $this->restErpInvoicePageSearchCollectionResponseMapper->fromSearchResult($data);

        static::assertEquals('sku', $transfer->getErpInvoices()[0]->getItems()[0]->getSku());
    }
}
