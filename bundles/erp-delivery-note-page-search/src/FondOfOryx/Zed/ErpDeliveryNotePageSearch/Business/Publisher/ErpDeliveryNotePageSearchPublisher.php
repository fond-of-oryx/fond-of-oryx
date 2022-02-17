<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface;
use Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddress;
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
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface
     */
    protected $erpDeliveryNotePageSearchDataMapper;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface $queryContainer
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface $utilEncodingService
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\ErpDeliveryNotePageSearchDataMapperInterface $erpDeliveryNotePageSearchDataMapper
     */
    public function __construct(
        ErpDeliveryNotePageSearchEntityManagerInterface $entityManager,
        ErpDeliveryNotePageSearchQueryContainerInterface $queryContainer,
        ErpDeliveryNotePageSearchToUtilEncodingServiceInterface $utilEncodingService,
        ErpDeliveryNotePageSearchDataMapperInterface $erpDeliveryNotePageSearchDataMapper
    ) {
        $this->entityManager = $entityManager;
        $this->queryContainer = $queryContainer;
        $this->utilEncodingService = $utilEncodingService;
        $this->erpDeliveryNotePageSearchDataMapper = $erpDeliveryNotePageSearchDataMapper;
    }

    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function publish(array $erpDeliveryNoteIds): void
    {
        $fooErpDeliveryNoteEntities = $this->queryContainer->queryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitByErpDeliveryNoteIds($erpDeliveryNoteIds)->find()
            ->getData();

        if (count($erpDeliveryNoteIds) > 0) {
            $this->entityManager->deleteErpDeliveryNoteSearchPagesByErpDeliveryNoteIds(
                $erpDeliveryNoteIds,
            );
        }

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
        $erpDeliveryNoteData[static::BILLING_ADDRESS] = $this->getAddress($billingAddress);
        $erpDeliveryNoteData[static::SHIPPING_ADDRESS] = $this->getAddress($shippingAddress);

        $erpDeliveryNotePageSearchTransfer = (new ErpDeliveryNotePageSearchTransfer())
            ->fromArray($erpDeliveryNoteData, true)
            ->setData($erpDeliveryNoteData)
            ->setFkErpDeliveryNote($fooErpDeliveryNoteEntity->getIdErpDeliveryNote());

        $erpDeliveryNotePageSearchTransfer = $this->addDataAttributes($erpDeliveryNotePageSearchTransfer);
        $erpDeliveryNotePageSearchTransfer = $this->addUniqueKeyIdentifier($erpDeliveryNotePageSearchTransfer, $fooErpDeliveryNoteEntity);

        $this->entityManager->createErpDeliveryNotePageSearch($erpDeliveryNotePageSearchTransfer);
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
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
     * @param \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNote $fooErpDeliveryNoteEntity
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer
     */
    protected function addUniqueKeyIdentifier(
        ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer,
        FooErpDeliveryNote $fooErpDeliveryNoteEntity
    ): ErpDeliveryNotePageSearchTransfer {
        $updatedAt = $fooErpDeliveryNoteEntity->getUpdatedAt();
        $hash = md5(sprintf('%s/%s', $updatedAt->getTimestamp(), mt_rand(0, 999)));
        $uki = sprintf('%s-%s', $fooErpDeliveryNoteEntity->getIdErpDeliveryNote(), $hash);

        return $erpDeliveryNotePageSearchTransfer->setUniqueKeyIdentifier($uki);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpense[] $orderExpenseEntities
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
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItem[] $orderItemEntities
     *
     * @return array
     */
    protected function getItems(ObjectCollection $orderItemEntities): array
    {
        $items = [];
        foreach ($orderItemEntities as $orderItemEntity) {
            $item = $orderItemEntity->toArray();
            $items[] = $item;
        }

        return $items;
    }
}
