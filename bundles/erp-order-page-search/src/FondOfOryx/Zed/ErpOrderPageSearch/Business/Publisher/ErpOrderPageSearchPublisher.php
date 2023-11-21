<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher;

use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\Map\ErpOrderItemTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;

class ErpOrderPageSearchPublisher implements ErpOrderPageSearchPublisherInterface
{
    /**
     * @var string
     */
    public const COMPANY_BUSINESS_UNIT = 'companyBusinessUnit';

    /**
     * @var string
     */
    public const ITEMS = 'items';

    /**
     * @var string
     */
    public const ERP_ORDER_EXPENSES = 'erpOrderExpenses';

    /**
     * @var string
     */
    public const TOTALS = 'totals';

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
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface
     */
    protected $erpOrderPageSearchDataMapper;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface $queryContainer
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface $utilEncodingService
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface $erpOrderPageSearchDataMapper
     */
    public function __construct(
        ErpOrderPageSearchEntityManagerInterface $entityManager,
        ErpOrderPageSearchQueryContainerInterface $queryContainer,
        ErpOrderPageSearchToUtilEncodingServiceInterface $utilEncodingService,
        ErpOrderPageSearchDataMapperInterface $erpOrderPageSearchDataMapper
    ) {
        $this->entityManager = $entityManager;
        $this->queryContainer = $queryContainer;
        $this->utilEncodingService = $utilEncodingService;
        $this->erpOrderPageSearchDataMapper = $erpOrderPageSearchDataMapper;
    }

    /**
     * @param array<int> $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void
    {
        $fooErpOrderEntities = $this->queryContainer->queryErpOrderWithAddressesAndCompanyBusinessUnitByErpOrderIds($erpOrderIds)->find()
            ->getData();

        if (count($erpOrderIds) > 0) {
            $this->entityManager->deleteErpOrderSearchPagesByErpOrderIds(
                $erpOrderIds,
            );
        }

        $this->storeData($fooErpOrderEntities);
    }

    /**
     * @param array<\Orm\Zed\ErpOrder\Persistence\ErpOrder> $fooErpOrderEntities
     *
     * @return void
     */
    protected function storeData(array $fooErpOrderEntities): void
    {
        foreach ($fooErpOrderEntities as $fooErpOrderEntity) {
            $this->storeDataSet($fooErpOrderEntity);
        }
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrder $fooErpOrderEntity
     *
     * @return void
     */
    protected function storeDataSet(ErpOrder $fooErpOrderEntity): void
    {
        $erpOrderData = $fooErpOrderEntity->toArray();
        $companyBusinessUnit = $fooErpOrderEntity->getCompanyBusinessUnit();
        $orderItems = $fooErpOrderEntity->getErpOrderItems(
            (new Criteria())->addAscendingOrderByColumn(ErpOrderItemTableMap::COL_POSITION),
        );
        $totals = $fooErpOrderEntity->getErpOrderTotals();
        $billingAddress = $fooErpOrderEntity->getErpOrderBillingAddress();
        $shippingAddress = $fooErpOrderEntity->getErpOrderShippingAddress();
        $orderExpenseEntities = $fooErpOrderEntity->getFooErpOrderExpenses();

        $erpOrderData[static::COMPANY_BUSINESS_UNIT] = $companyBusinessUnit->toArray();
        $erpOrderData[static::ITEMS] = $this->getItems($orderItems);
        $erpOrderData[static::ERP_ORDER_EXPENSES] = $this->getExpenses($orderExpenseEntities);
        $erpOrderData[static::BILLING_ADDRESS] = $this->getAddress($billingAddress);
        $erpOrderData[static::SHIPPING_ADDRESS] = $this->getAddress($shippingAddress);
        $erpOrderData[static::TOTALS] = $totals->toArray();

        $erpOrderPageSearchTransfer = (new ErpOrderPageSearchTransfer())
            ->fromArray($erpOrderData, true)
            ->setData($erpOrderData)
            ->setFkErpOrder($fooErpOrderEntity->getIdErpOrder());

        $erpOrderPageSearchTransfer = $this->addDataAttributes($erpOrderPageSearchTransfer);
        $erpOrderPageSearchTransfer = $this->addUniqueKeyIdentifier($erpOrderPageSearchTransfer, $fooErpOrderEntity);

        $this->entityManager->createErpOrderPageSearch($erpOrderPageSearchTransfer);
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrderAddress $erpOrderAddressEntity
     *
     * @return array
     */
    protected function getAddress(ErpOrderAddress $erpOrderAddressEntity): array
    {
        $address = $erpOrderAddressEntity->toArray();
        $address[static::FIELD_COUNTRY] = $erpOrderAddressEntity->getCountry()->getIso2Code();

        return $address;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    protected function addDataAttributes(
        ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
    ): ErpOrderPageSearchTransfer {
        $data = array_merge(
            $erpOrderPageSearchTransfer->toArray(),
            $erpOrderPageSearchTransfer->getData(),
        );

        $data = $this->erpOrderPageSearchDataMapper
            ->mapErpOrderDataToSearchData($data);

        $structuredData = $this->utilEncodingService->encodeJson($data);

        return $erpOrderPageSearchTransfer->setData($data)
            ->setStructuredData($structuredData);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ErpOrder\Persistence\FooErpOrderExpense> $orderExpenseEntities
     *
     * @return array
     */
    protected function getExpenses(ObjectCollection $orderExpenseEntities): array
    {
        $expenses = [];
        foreach ($orderExpenseEntities as $orderExpenseEntity) {
            $expense = $orderExpenseEntity->toArray();
            $expense['amount'] = $orderExpenseEntity->getFooErpOrderAmount()->toArray();
            $expense['unit_price'] = $orderExpenseEntity->getFooErpOrderAmountUnitPrice()->toArray();
            $expenses[] = $expense;
        }

        return $expenses;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\ErpOrder\Persistence\ErpOrderItem> $orderItemEntities
     *
     * @return array
     */
    protected function getItems(ObjectCollection $orderItemEntities): array
    {
        $items = [];
        foreach ($orderItemEntities as $orderItemEntity) {
            $item = $orderItemEntity->toArray();

            $amountEntity = $orderItemEntity->getFooErpOrderAmount();
            $unitPriceEntity = $orderItemEntity->getFooErpOrderAmountUnitPrice();

            if ($amountEntity !== null) {
                $item['amount'] = $amountEntity->toArray();
            }

            if ($unitPriceEntity !== null) {
                $item['unit_price'] = $unitPriceEntity->toArray();
            }

            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     * @param \Orm\Zed\ErpOrder\Persistence\ErpOrder $fooErpOrderEntity
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    protected function addUniqueKeyIdentifier(
        ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer,
        ErpOrder $fooErpOrderEntity
    ): ErpOrderPageSearchTransfer {
        $updatedAt = $fooErpOrderEntity->getUpdatedAt();
        $hash = md5(sprintf('%s/%s', $updatedAt->getTimestamp(), mt_rand(0, 999)));
        $uki = sprintf('%s-%s', $fooErpOrderEntity->getIdErpOrder(), $hash);

        return $erpOrderPageSearchTransfer->setUniqueKeyIdentifier($uki);
    }
}
