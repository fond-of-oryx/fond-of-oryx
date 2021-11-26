<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher;

use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface;
use Generated\Shared\Transfer\ErpInvoicePageSearchTransfer;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoice;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress;
use Propel\Runtime\Collection\ObjectCollection;

class ErpInvoicePageSearchPublisher implements ErpInvoicePageSearchPublisherInterface
{
    /**
     * @var string
     */
    public const COMPANY_BUSINESS_UNIT = 'companyBusinessUnit';

    /**
     * @var string
     */
    public const ERP_INVOICE_ITEMS = 'erpInvoiceItems';

    /**
     * @var string
     */
    public const ERP_INVOICE_EXPENSES = 'erpInvoiceExpenses';

    /**
     * @var string
     */
    public const ERP_INVOICE_TOTAL = 'erpInvoiceTotal';

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
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface
     */
    protected $erpInvoicePageSearchDataMapper;

    /**
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface $queryContainer
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface $utilEncodingService
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface $erpInvoicePageSearchDataMapper
     */
    public function __construct(
        ErpInvoicePageSearchEntityManagerInterface $entityManager,
        ErpInvoicePageSearchQueryContainerInterface $queryContainer,
        ErpInvoicePageSearchToUtilEncodingServiceInterface $utilEncodingService,
        ErpInvoicePageSearchDataMapperInterface $erpInvoicePageSearchDataMapper
    ) {
        $this->entityManager = $entityManager;
        $this->queryContainer = $queryContainer;
        $this->utilEncodingService = $utilEncodingService;
        $this->erpInvoicePageSearchDataMapper = $erpInvoicePageSearchDataMapper;
    }

    /**
     * @param array<int> $erpInvoiceIds
     *
     * @return void
     */
    public function publish(array $erpInvoiceIds): void
    {
        $fooErpInvoiceEntities = $this->queryContainer->queryErpInvoiceWithAddressesAndCompanyBusinessUnitByErpInvoiceIds($erpInvoiceIds)->find()
            ->getData();

        if (count($erpInvoiceIds) > 0) {
            $this->entityManager->deleteErpInvoiceSearchPagesByErpInvoiceIds(
                $erpInvoiceIds,
            );
        }

        $this->storeData($fooErpInvoiceEntities);
    }

    /**
     * @param array<\Orm\Zed\ErpInvoice\Persistence\FooErpInvoice> $fooErpInvoiceEntities
     *
     * @return void
     */
    protected function storeData(array $fooErpInvoiceEntities): void
    {
        foreach ($fooErpInvoiceEntities as $fooErpInvoiceEntity) {
            $this->storeDataSet($fooErpInvoiceEntity);
        }
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoice $fooErpInvoiceEntity
     *
     * @return void
     */
    protected function storeDataSet(FooErpInvoice $fooErpInvoiceEntity): void
    {
        $erpInvoiceData = $fooErpInvoiceEntity->toArray();
        $companyBusinessUnit = $fooErpInvoiceEntity->getSpyCompanyBusinessUnit();
        $orderItemEntities = $fooErpInvoiceEntity->getFooErpInvoiceItems();
        $orderExpenseEntities = $fooErpInvoiceEntity->getFooErpInvoiceExpenses();

        $orderTotal = $fooErpInvoiceEntity->getFooErpInvoiceAmountToal();
        $billingAddress = $fooErpInvoiceEntity->getFooErpInvoiceBillingAddress();
        $shippingAddress = $fooErpInvoiceEntity->getFooErpInvoiceShippingAddress();

        $erpInvoiceData[static::COMPANY_BUSINESS_UNIT] = $companyBusinessUnit->toArray();
        $erpInvoiceData[static::ERP_INVOICE_ITEMS] = $this->getItems($orderItemEntities);
        $erpInvoiceData[static::ERP_INVOICE_EXPENSES] = $this->getExpenses($orderExpenseEntities);
        $erpInvoiceData[static::BILLING_ADDRESS] = $this->getAddress($billingAddress);
        $erpInvoiceData[static::SHIPPING_ADDRESS] = $this->getAddress($shippingAddress);
        $erpInvoiceData[static::ERP_INVOICE_TOTAL] = $orderTotal->toArray();

        $erpInvoicePageSearchTransfer = (new ErpInvoicePageSearchTransfer())
            ->fromArray($erpInvoiceData, true)
            ->setData($erpInvoiceData)
            ->setFkErpInvoice($fooErpInvoiceEntity->getIdErpInvoice());

        $erpInvoicePageSearchTransfer = $this->addDataAttributes($erpInvoicePageSearchTransfer);
        $erpInvoicePageSearchTransfer = $this->addUniqueKeyIdentifier($erpInvoicePageSearchTransfer, $fooErpInvoiceEntity);

        $this->entityManager->createErpInvoicePageSearch($erpInvoicePageSearchTransfer);
    }

    /**
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress $erpInvoiceAddressEntity
     *
     * @return array
     */
    protected function getAddress(FooErpInvoiceAddress $erpInvoiceAddressEntity): array
    {
        $address = $erpInvoiceAddressEntity->toArray();
        $address[static::FIELD_COUNTRY] = $erpInvoiceAddressEntity->getSpyCountry()->getIso2Code();

        return $address;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer
     */
    protected function addDataAttributes(
        ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer
    ): ErpInvoicePageSearchTransfer {
        $data = array_merge(
            $erpInvoicePageSearchTransfer->toArray(),
            $erpInvoicePageSearchTransfer->getData(),
        );

        $data = $this->erpInvoicePageSearchDataMapper
            ->mapErpInvoiceDataToSearchData($data);

        $structuredData = $this->utilEncodingService->encodeJson($data);

        return $erpInvoicePageSearchTransfer->setData($data)
            ->setStructuredData($structuredData);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer
     * @param \Orm\Zed\ErpInvoice\Persistence\FooErpInvoice $fooErpInvoiceEntity
     *
     * @return \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer
     */
    protected function addUniqueKeyIdentifier(
        ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer,
        FooErpInvoice $fooErpInvoiceEntity
    ): ErpInvoicePageSearchTransfer {
        $updatedAt = $fooErpInvoiceEntity->getUpdatedAt();
        $hash = md5(sprintf('%s/%s', $updatedAt->getTimestamp(), mt_rand(0, 999)));
        $uki = sprintf('%s-%s', $fooErpInvoiceEntity->getIdErpInvoice(), $hash);

        return $erpInvoicePageSearchTransfer->setUniqueKeyIdentifier($uki);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense[] $orderExpenseEntities
     *
     * @return array
     */
    protected function getExpenses(ObjectCollection $orderExpenseEntities): array
    {
        $expenses = [];
        foreach ($orderExpenseEntities as $orderExpenseEntity) {
            $expense = $orderExpenseEntity->toArray();
            $expense['amount'] = $orderExpenseEntity->getFooErpInvoiceAmount()->toArray();
            $expense['unit_price'] = $orderExpenseEntity->getFooErpInvoiceAmountUnitPrice()->toArray();
            $expenses[] = $expense;
        }

        return $expenses;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem[] $orderItemEntities
     *
     * @return array
     */
    protected function getItems(ObjectCollection $orderItemEntities): array
    {
        $items = [];
        foreach ($orderItemEntities as $orderItemEntity) {
            $item = $orderItemEntity->toArray();
            $item['amount'] = $orderItemEntity->getFooErpInvoiceAmount()->toArray();
            $item['unit_price'] = $orderItemEntity->getFooErpInvoiceAmountUnitPrice()->toArray();
            $items[] = $item;
        }

        return $items;
    }
}
