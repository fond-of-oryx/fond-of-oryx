<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteTransfer;

class ErpDeliveryNoteMapper implements ErpDeliveryNoteMapperInterface
{
    /**
     * @var string
     */
    protected const SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES = 'erp-delivery-notes';

    /**
     * @var string
     */
    protected const ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_ITEMS = 'erp_delivery_note_items';

    /**
     * @var string
     */
    protected const ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_EXPENSES = 'erp_delivery_note_expenses';

    /**
     * @var string
     */
    protected const ERP_DELIVERY_NOTE_DATA_KEY_COMPANY_BUSINESS_UNIT = 'company_business_unit';

    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer
     */
    public function mapErpDeliveryNoteResource(
        array $searchResults
    ): RestErpDeliveryNotePageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpDeliveryNotePageSearchCollectionResponseTransfer())->fromArray($searchResults, true);

        if (
            !array_key_exists(static::SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES, $searchResults)
            || !is_array($searchResults[static::SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES])
        ) {
            return $responseTransfer;
        }

        foreach ($searchResults[static::SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES] as $erpDeliveryNoteData) {
            $restErpDeliveryNote = new RestErpDeliveryNoteTransfer();
            $restErpDeliveryNote->fromArray($erpDeliveryNoteData, true);
            $restErpDeliveryNote->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_DATA_KEY_COMPANY_BUSINESS_UNIT],
                ),
            );

            $this->addRestErpDeliveryNoteItems($restErpDeliveryNote, $erpDeliveryNoteData[self::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_ITEMS]);
            $this->addRestErpDeliveryNoteExpenses($restErpDeliveryNote, $erpDeliveryNoteData[self::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_EXPENSES]);

            $responseTransfer->addErpDeliveryNote($restErpDeliveryNote);
        }

        return $responseTransfer;
    }

    /**
     * @param array $companyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer
     */
    protected function mapCompanyBusinessUnitToRestCompanyBusinessUnit(
        array $companyBusinessUnit
    ): RestCompanyBusinessUnitTransfer {
        return (new RestCompanyBusinessUnitTransfer())->fromArray($companyBusinessUnit, true);
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpDeliveryNoteTransfer $restErpDeliveryNoteTransfer
     * @param array $erpDeliveryNoteItems
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNoteTransfer
     */
    protected function addRestErpDeliveryNoteItems(
        RestErpDeliveryNoteTransfer $restErpDeliveryNoteTransfer,
        array $erpDeliveryNoteItems
    ): RestErpDeliveryNoteTransfer {
        foreach ($erpDeliveryNoteItems as $erpDeliveryNoteItemData) {
            $restErpDeliveryNoteItemTransfer = (new RestErpDeliveryNoteItemTransfer())->fromArray($erpDeliveryNoteItemData, true);
            $restErpDeliveryNoteTransfer->addItem($restErpDeliveryNoteItemTransfer);
        }

        return $restErpDeliveryNoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpDeliveryNoteTransfer $restErpDeliveryNoteTransfer
     * @param array $erpDeliveryNoteExpenses
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNoteTransfer
     */
    protected function addRestErpDeliveryNoteExpenses(
        RestErpDeliveryNoteTransfer $restErpDeliveryNoteTransfer,
        array $erpDeliveryNoteExpenses
    ): RestErpDeliveryNoteTransfer {
        foreach ($erpDeliveryNoteExpenses as $erpDeliveryNoteExpenseData) {
            $restErpDeliveryNoteItemTransfer = (new RestErpDeliveryNoteExpenseTransfer())->fromArray($erpDeliveryNoteExpenseData, true);
            $restErpDeliveryNoteTransfer->addExpense($restErpDeliveryNoteItemTransfer);
        }

        return $restErpDeliveryNoteTransfer;
    }
}
