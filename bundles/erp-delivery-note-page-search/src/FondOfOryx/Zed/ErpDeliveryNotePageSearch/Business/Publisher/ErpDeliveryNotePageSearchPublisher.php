<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface;
use Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem;
use Propel\Runtime\Collection\ObjectCollection;

class ErpDeliveryNotePageSearchPublisher implements ErpDeliveryNotePageSearchPublisherInterface
{
    /**
     * @var string
     */
    public const COMPANY_BUSINESS_UNIT = 'companyBusinessUnit';

    /**
     * @var string
     */
    public const ERP_DELIVERY_NOTE_ITEMS = 'erpDeliveryNoteItems';

    /**
     * @var string
     */
    public const ERP_DELIVERY_NOTE_EXPENSES = 'erpDeliveryNoteExpenses';

    /**
     * @var string
     */
    public const ERP_DELIVERY_NOTE_TRACKING = 'erpDeliveryNoteTracking';

    /**
     * @var string
     */
    public const BILLING_ADDRESS = 'billingAddress';

    /**
     * @var string
     */
    public const SHIPPING_ADDRESS = 'shippingAddress';

    /**
     * @var string
     */
    public const FIELD_COUNTRY = 'country';

    /**
     * @var string
     */
    public const FIELD_QUANTITY = 'quantity';

    /**
     * @var string
     */
    public const FIELD_SKU = 'sku';

    /**
     * @var string
     */
    public const FIELD_TRACKING_DATA = 'tracking_data';

    /**
     * @var string
     */
    public const FIELD_TRACKING_NUMBER = 'tracking_number';

    /**
     * @var string
     */
    public const FIELD_SHIPPING_AGENT_CODE = 'shipping_agent_code';

    /**
     * @var string
     */
    public const FIELD_TRACKING_URL = 'tracking_url';

    /**
     * @var string
     */
    public const FIELD_ITEMS = 'items';

    protected ErpDeliveryNotePageSearchEntityManagerInterface $entityManager;

    protected ErpDeliveryNotePageSearchQueryContainerInterface $queryContainer;

    protected ErpDeliveryNotePageSearchToUtilEncodingServiceInterface $utilEncodingService;

    protected ErpDeliveryNotePageSearchDataMapperInterface $erpDeliveryNotePageSearchDataMapper;

    protected ErpDeliveryNotePageSearchConfig $config;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface $queryContainer
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface $utilEncodingService
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface $erpDeliveryNotePageSearchDataMapper
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig $config
     */
    public function __construct(
        ErpDeliveryNotePageSearchEntityManagerInterface $entityManager,
        ErpDeliveryNotePageSearchQueryContainerInterface $queryContainer,
        ErpDeliveryNotePageSearchToUtilEncodingServiceInterface $utilEncodingService,
        ErpDeliveryNotePageSearchDataMapperInterface $erpDeliveryNotePageSearchDataMapper,
        ErpDeliveryNotePageSearchConfig $config
    ) {
        $this->entityManager = $entityManager;
        $this->queryContainer = $queryContainer;
        $this->utilEncodingService = $utilEncodingService;
        $this->erpDeliveryNotePageSearchDataMapper = $erpDeliveryNotePageSearchDataMapper;
        $this->config = $config;
    }

    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function publish(array $erpDeliveryNoteIds): void
    {
        $fooErpDeliveryNoteEntities = $this->queryContainer
            ->queryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitByErpDeliveryNoteIds($erpDeliveryNoteIds)
            ->find()
            ->getData();

        $this->storeData($fooErpDeliveryNoteEntities);
    }

    /**
     * @param array<\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote> $fooErpDeliveryNoteEntities
     *
     * @return void
     */
    protected function storeData(array $fooErpDeliveryNoteEntities): void
    {
        foreach ($fooErpDeliveryNoteEntities as $fooErpDeliveryNoteEntity) {
            $this->storeDataSet($fooErpDeliveryNoteEntity);
        }
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote $fooErpDeliveryNoteEntity
     *
     * @return void
     */
    protected function storeDataSet(FooErpDeliveryNote $fooErpDeliveryNoteEntity): void
    {
        $erpDeliveryNoteData = $fooErpDeliveryNoteEntity->toArray();
        $companyBusinessUnit = $fooErpDeliveryNoteEntity->getSpyCompanyBusinessUnit();
        $orderItemEntities = $fooErpDeliveryNoteEntity->getFooErpDeliveryNoteItems();
        $orderExpenseEntities = $fooErpDeliveryNoteEntity->getFooErpDeliveryNoteExpenses();

        $billingAddress = $fooErpDeliveryNoteEntity->getFooErpDeliveryNoteBillingAddress();
        $shippingAddress = $fooErpDeliveryNoteEntity->getFooErpDeliveryNoteShippingAddress();

        $erpDeliveryNoteData[static::COMPANY_BUSINESS_UNIT] = $companyBusinessUnit->toArray();
        $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_ITEMS] = $this->getItems($orderItemEntities);
        $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_EXPENSES] = $this->getExpenses($orderExpenseEntities);
        $erpDeliveryNoteData[static::ERP_DELIVERY_NOTE_TRACKING] = $this->getTracking($orderItemEntities);
        $erpDeliveryNoteData[static::BILLING_ADDRESS] = $this->getAddress($billingAddress);
        $erpDeliveryNoteData[static::SHIPPING_ADDRESS] = $this->getAddress($shippingAddress);

        $erpDeliveryNotePageSearchTransfer = (new ErpDeliveryNotePageSearchTransfer())
            ->fromArray($erpDeliveryNoteData, true)
            ->setData($erpDeliveryNoteData)
            ->setFkErpDeliveryNote($fooErpDeliveryNoteEntity->getIdErpDeliveryNote());

        $erpDeliveryNotePageSearchTransfer = $this->addDataAttributes($erpDeliveryNotePageSearchTransfer);

        $this->entityManager->persistErpDeliveryNotePageSearch($erpDeliveryNotePageSearchTransfer);
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress $erpDeliveryNoteAddressEntity
     *
     * @return array
     */
    protected function getAddress(FooErpDeliveryNoteAddress $erpDeliveryNoteAddressEntity): array
    {
        $address = $erpDeliveryNoteAddressEntity->toArray();
        $address[static::FIELD_COUNTRY] = $erpDeliveryNoteAddressEntity->getSpyCountry()->getIso2Code();

        return $address;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer
     */
    protected function addDataAttributes(
        ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
    ): ErpDeliveryNotePageSearchTransfer {
        $data = array_merge(
            $erpDeliveryNotePageSearchTransfer->toArray(),
            $erpDeliveryNotePageSearchTransfer->getData(),
        );

        $data = $this->erpDeliveryNotePageSearchDataMapper
            ->mapErpDeliveryNoteDataToSearchData($data);

        $structuredData = $this->utilEncodingService->encodeJson($data);

        return $erpDeliveryNotePageSearchTransfer->setData($data)
            ->setStructuredData($structuredData);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense> $orderExpenseEntities
     *
     * @return array
     */
    protected function getExpenses(ObjectCollection $orderExpenseEntities): array
    {
        $expenses = [];
        foreach ($orderExpenseEntities as $orderExpenseEntity) {
            $expense = $orderExpenseEntity->toArray();
            $expenses[] = $expense;
        }

        return $expenses;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem> $orderItemEntities
     *
     * @return array
     */
    protected function getTracking(ObjectCollection $orderItemEntities): array
    {
        $tracking = [];
        /** @var \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem $orderItemEntity */
        foreach ($orderItemEntities->getData() as $orderItemEntity) {
            foreach ($orderItemEntity->getFooErpDeliveryNoteTrackingToItems() as $trackingToItem) {
                $trackingEntity = $trackingToItem->getFooErpDeliveryNoteTracking();
                $trackingData = $trackingEntity->toArray();
                $trackingData[static::FIELD_QUANTITY] = $trackingToItem->getQuantity();
                $tracking[$trackingEntity->getTrackingNumber()][$orderItemEntity->getSku()] = $this->cleanBlacklistedData($this->config->getTrackingDataFieldsToRemove(), $trackingData);
            }
        }

        return $this->optimizeForElasticSearchToReduceDynamicFields($tracking);
    }

    /**
     * @param array $blacklist
     * @param array $trackingData
     *
     * @return array
     */
    protected function cleanBlacklistedData(array $blacklist, array $trackingData): array
    {
        foreach ($blacklist as $key) {
            if (array_key_exists($key, $trackingData)) {
                unset($trackingData[$key]);
            }
        }

        return $trackingData;
//        return array_diff_key(array_flip($blacklist), $trackingData);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem> $orderItemEntities
     *
     * @return array
     */
    protected function getItems(ObjectCollection $orderItemEntities): array
    {
        $items = [];
        foreach ($orderItemEntities as $orderItemEntity) {
            $item = $orderItemEntity->toArray();
            $item[static::FIELD_TRACKING_DATA] = $this->appendItemTrackingData($orderItemEntity);
            $items[] = $this->cleanBlacklistedData($this->config->getItemDataFieldsToRemove(), $item);
        }

        return $items;
    }

    /**
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem $fooErpDeliveryNoteItemEntity
     *
     * @return array
     */
    protected function appendItemTrackingData(FooErpDeliveryNoteItem $fooErpDeliveryNoteItemEntity): array
    {
        $tracking = [];

        foreach ($fooErpDeliveryNoteItemEntity->getFooErpDeliveryNoteTrackingToItems() as $trackingToItem) {
            $trackingEntity = $trackingToItem->getFooErpDeliveryNoteTracking();
            $trackingData = $trackingEntity->toArray();
            $trackingData[static::FIELD_QUANTITY] = $trackingToItem->getQuantity();
            $tracking[] = $this->cleanBlacklistedData($this->config->getTrackingDataFieldsToRemove(), $trackingData);
        }

        return $tracking;
    }

    /**
     * @param array $tracking
     *
     * @return array
     */
    protected function optimizeForElasticSearchToReduceDynamicFields(array $tracking): array
    {
        $optimizedTrackingData = [];
        foreach ($tracking as $trackingNumber => $trackingCollection) {
            $trackingPart = [
                static::FIELD_TRACKING_NUMBER => $trackingNumber,
            ];
            $items = [];
            foreach ($trackingCollection as $sku => $item) {
                $reducedItem = [
                    static::FIELD_QUANTITY => $item[static::FIELD_QUANTITY],
                    static::FIELD_SKU => $sku,
                ];
                $trackingPart[static::FIELD_SHIPPING_AGENT_CODE] = $item[static::FIELD_SHIPPING_AGENT_CODE];
                $trackingPart[static::FIELD_TRACKING_URL] = $item[static::FIELD_TRACKING_URL];
                $items[] = $reducedItem;
            }
            $trackingPart[static::FIELD_ITEMS] = $items;
            $optimizedTrackingData[] = $trackingPart;
        }

        return $optimizedTrackingData;
    }
}
