<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Codeception\Test\Unit;

class RestErpDeliveryNotePageSearchCollectionResponseMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
     */
    protected $restErpDeliveryNotePageSearchCollectionResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restErpDeliveryNotePageSearchCollectionResponseMapper = new RestErpDeliveryNotePageSearchCollectionResponseMapper();
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

        $transfer = $this->restErpDeliveryNotePageSearchCollectionResponseMapper->fromSearchResult($data);

        static::assertEquals('sku', $transfer->getErpDeliveryNotes()[0]->getItems()[0]->getSku());
    }
}
