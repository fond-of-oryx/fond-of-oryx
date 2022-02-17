<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;

class ErpDeliveryNoteMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\ErpDeliveryNoteMapperInterface
     */
    protected $erpDeliveryNoteMapper;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->erpDeliveryNoteMapper = new ErpDeliveryNoteMapper();
    }

    /**
     * @return void
     */
    public function testMapErpDeliveryNoteResource(): void
    {
        $data = [
            'erp-delivery-notes' => [
                0 => [
                    'erp_delivery_note_items' => [
                        0 => ['sku' => 'sku'],
                    ],
                    'erp_delivery_note_expenses' => [
                        0 => ['name' => 'name'],
                    ],
                    'company_business_unit' => [
                        0 => ['name' => 'Default Unit'],
                    ],
                ],
            ],
        ];
        $transfer = $this->erpDeliveryNoteMapper->mapErpDeliveryNoteResource($data);

        $this->assertInstanceOf(RestErpDeliveryNotePageSearchCollectionResponseTransfer::class, $transfer);
        $this->assertEquals('sku', $transfer->getErpDeliveryNotes()[0]->getItems()[0]->getSku());
    }
}
