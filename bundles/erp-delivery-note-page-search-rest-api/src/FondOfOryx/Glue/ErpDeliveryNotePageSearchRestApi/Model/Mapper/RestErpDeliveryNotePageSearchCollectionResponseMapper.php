<?php

declare(strict_types=1);

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use ArrayObject;
use FondOfOryx\Shared\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiConstants;
use Generated\Shared\Transfer\RestCompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteGlobalTrackingItemTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteGlobalTrackingTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteItemTrackingTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNoteTransfer;

class RestErpDeliveryNotePageSearchCollectionResponseMapper implements RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
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
    protected const ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_ITEMS_TRACKING_DATA = 'tracking_data';

    /**
     * @var string
     */
    protected const ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_EXPENSES = 'erp_delivery_note_expenses';

    /**
     * @var string
     */
    protected const ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_TRACKING = 'erp_delivery_note_tracking';

    /**
     * @var string
     */
    protected const ERP_DELIVERY_NOTE_DATA_KEY_COMPANY_BUSINESS_UNIT = 'company_business_unit';

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapperInterface
     */
    protected $restErpDeliveryNotePageSearchPaginationMapper;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapperInterface
     */
    protected $restErpDeliveryNotePageSearchPaginationSortMapper;

    /**
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationMapperInterface $restErpDeliveryNotePageSearchPaginationMapper
     * @param \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper\RestErpDeliveryNotePageSearchPaginationSortMapperInterface $restErpDeliveryNotePageSearchPaginationSortMapper
     */
    public function __construct(
        RestErpDeliveryNotePageSearchPaginationMapperInterface $restErpDeliveryNotePageSearchPaginationMapper,
        RestErpDeliveryNotePageSearchPaginationSortMapperInterface $restErpDeliveryNotePageSearchPaginationSortMapper
    ) {
        $this->restErpDeliveryNotePageSearchPaginationMapper = $restErpDeliveryNotePageSearchPaginationMapper;
        $this->restErpDeliveryNotePageSearchPaginationSortMapper = $restErpDeliveryNotePageSearchPaginationSortMapper;
    }

    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer
     */
    public function fromSearchResult(
        array $searchResult
    ): RestErpDeliveryNotePageSearchCollectionResponseTransfer {
        $responseTransfer = (new RestErpDeliveryNotePageSearchCollectionResponseTransfer())
            ->setSort($this->restErpDeliveryNotePageSearchPaginationSortMapper->fromSearchResult($searchResult))
            ->setPagination($this->restErpDeliveryNotePageSearchPaginationMapper->fromSearchResult($searchResult));

        if (
            !array_key_exists(static::SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES, $searchResult)
            || !is_array($searchResult[static::SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES])
        ) {
            return $responseTransfer;
        }

        foreach ($searchResult[static::SEARCH_RESULT_KEY_ERP_DELIVERY_NOTES] as $erpDeliveryNoteData) {
            $restErpDeliveryNote = new RestErpDeliveryNoteTransfer();
            $restErpDeliveryNote->fromArray($erpDeliveryNoteData, true);
            $restErpDeliveryNote->setCompanyBusinessUnit(
                $this->mapCompanyBusinessUnitToRestCompanyBusinessUnit(
                    $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_DATA_KEY_COMPANY_BUSINESS_UNIT],
                ),
            );

            $this->addRestErpDeliveryNoteItems($restErpDeliveryNote, $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_ITEMS]);
            $this->addRestErpDeliveryNoteExpenses($restErpDeliveryNote, $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_EXPENSES]);
            if (array_key_exists(static::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_TRACKING, $erpDeliveryNoteData)) {
                $this->addRestErpDeliveryNoteTracking($restErpDeliveryNote, $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_TRACKING]);
            }

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
            $restErpDeliveryNoteItemTransfer = $this->mapItemTrackingData($restErpDeliveryNoteItemTransfer, $erpDeliveryNoteItemData);
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

    /**
     * @param \Generated\Shared\Transfer\RestErpDeliveryNoteTransfer $restErpDeliveryNoteTransfer
     * @param array $erpDeliveryNoteTracking
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNoteTransfer
     */
    protected function addRestErpDeliveryNoteTracking(
        RestErpDeliveryNoteTransfer $restErpDeliveryNoteTransfer,
        array $erpDeliveryNoteTracking
    ): RestErpDeliveryNoteTransfer {
        foreach ($erpDeliveryNoteTracking as $erpDeliveryNoteTrackingData) {
            $trackingTransfer = null;
            foreach ($erpDeliveryNoteTrackingData[ErpDeliveryNotePageSearchRestApiConstants::FIELD_ITEMS] as $itemTrackingData) {
                if ($trackingTransfer === null) {
                    $trackingTransfer = (new RestErpDeliveryNoteGlobalTrackingTransfer())->fromArray($erpDeliveryNoteTrackingData, true);
                    $trackingTransfer->setQuantity(0);
                }
                $item = (new RestErpDeliveryNoteGlobalTrackingItemTransfer())->fromArray($itemTrackingData);
                $trackingTransfer->setQuantity($trackingTransfer->getQuantity() + $item->getQuantity())->addItem($item);
            }
            if ($trackingTransfer !== null) {
                $restErpDeliveryNoteTransfer->addTracking($trackingTransfer);
            }
        }

        return $restErpDeliveryNoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErpDeliveryNoteItemTransfer $itemTransfer
     * @param array $erpDeliveryNoteItemData
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNoteItemTransfer
     */
    protected function mapItemTrackingData(
        RestErpDeliveryNoteItemTransfer $itemTransfer,
        array $erpDeliveryNoteItemData
    ): RestErpDeliveryNoteItemTransfer {
        if (array_key_exists(static::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_ITEMS_TRACKING_DATA, $erpDeliveryNoteItemData)) {
            $collection = new ArrayObject();
            foreach ($erpDeliveryNoteItemData[static::ERP_DELIVERY_NOTE_DATA_KEY_ERP_DELIVERY_NOTE_ITEMS_TRACKING_DATA] as $itemTrackingData) {
                $collection->append((new RestErpDeliveryNoteItemTrackingTransfer())->fromArray($itemTrackingData, true));
            }
            $itemTransfer->setTrackingData($collection);
        }

        return $itemTransfer;
    }
}
