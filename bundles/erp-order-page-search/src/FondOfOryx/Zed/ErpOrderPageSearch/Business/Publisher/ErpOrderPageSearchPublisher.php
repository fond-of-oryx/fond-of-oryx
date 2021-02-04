<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher;

use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;

class ErpOrderPageSearchPublisher implements ErpOrderPageSearchPublisherInterface
{
    public const COMPANY_BUSINESS_UNIT = 'companyBusinessUnit';
    public const COMPANY_USER = 'companyUser';
    public const ERP_ORDER_ITEMS = 'erpOrderItems';
    public const BILLING_ADDRESS = 'billingAddress';
    public const SHIPPING_ADDRESS = 'shippingAddress';

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
     * ErpOrderPageSearchPublisher constructor.
     *
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface  $entityManager
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface  $queryContainer
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface  $utilEncodingService
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface  $erpOrderPageSearchDataMapper
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
     * @param  int[]  $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void
    {
        $fooErpOrderEntities = $this->queryContainer->queryErpOrderWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpOrderIds($erpOrderIds)->find()
            ->getData();

        if (count($fooErpOrderEntities) > 0) {
            $this->entityManager->deleteErpOrderSearchPagesByErpOrderIds(
                $erpOrderIds
            );
        }

        $this->storeData($fooErpOrderEntities);
    }

    /**
     * @param  \Orm\Zed\ErpOrder\Persistence\ErpOrder[]  $fooErpOrderEntities
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
     * @param  \Orm\Zed\ErpOrder\Persistence\ErpOrder  $fooErpOrderEntity
     *
     * @return void
     */
    protected function storeDataSet(ErpOrder $fooErpOrderEntity): void
    {
        $erpOrderData = $fooErpOrderEntity->toArray();

        $companyBusinessUnit = $fooErpOrderEntity->getCompanyBusinessUnit();
        $companyUser = $fooErpOrderEntity->getCompanyUser();
        $orderItems = $fooErpOrderEntity->getErpOrderItems();
        $billingAddress = $fooErpOrderEntity->getErpOrderBillingAddress();
        $shippingAddress = $fooErpOrderEntity->getErpOrderShippingAddress();

        $erpOrderData[static::COMPANY_BUSINESS_UNIT] = $companyBusinessUnit->toArray();
        $erpOrderData[static::COMPANY_USER] = $companyUser->toArray();
        $erpOrderData[static::ERP_ORDER_ITEMS] = $orderItems->toArray();
        $erpOrderData[static::BILLING_ADDRESS] = $billingAddress->toArray();
        $erpOrderData[static::SHIPPING_ADDRESS] = $shippingAddress->toArray();

        $erpOrderPageSearchTransfer = (new ErpOrderPageSearchTransfer())
            ->fromArray($erpOrderData, true)
            ->setData($erpOrderData)
            ->setFkErpOrder($fooErpOrderEntity->getIdErpOrder());

        $erpOrderPageSearchTransfer = $this->addDataAttributes($erpOrderPageSearchTransfer);
        $erpOrderPageSearchTransfer = $this->addUniqueKeyIdentifier($erpOrderPageSearchTransfer, $fooErpOrderEntity);

        $this->entityManager->createErpOrderPageSearch($erpOrderPageSearchTransfer);
    }

    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchTransfer  $erpOrderPageSearchTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     */
    protected function addDataAttributes(
        ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
    ): ErpOrderPageSearchTransfer {
        $data = array_merge(
            $erpOrderPageSearchTransfer->toArray(),
            $erpOrderPageSearchTransfer->getData()
        );

        $data = $this->erpOrderPageSearchDataMapper
            ->mapErpOrderDataToSearchData($data);

        $structuredData = $this->utilEncodingService->encodeJson($data);

        return $erpOrderPageSearchTransfer->setData($data)
            ->setStructuredData($structuredData);
    }

    /**
     * @param  \Generated\Shared\Transfer\ErpOrderPageSearchTransfer  $erpOrderPageSearchTransfer
     * @param  \Orm\Zed\ErpOrder\Persistence\ErpOrder  $fooErpOrderEntity
     *
     * @return \Generated\Shared\Transfer\ErpOrderPageSearchTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     */
    protected function addUniqueKeyIdentifier(
        ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer,
        ErpOrder $fooErpOrderEntity
    ): ErpOrderPageSearchTransfer {
        $updatedAt = $fooErpOrderEntity->getUpdatedAt();
        $hash = md5($updatedAt->getTimestamp());
        $uki = sprintf('%s-%s', $fooErpOrderEntity->getIdErpOrder(), $hash);
        return $erpOrderPageSearchTransfer->setUniqueKeyIdentifier($uki);
    }
}
