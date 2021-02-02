<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Model;

use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;

class ErpOrderPageSearchPublisher implements ErpOrderPageSearchPublisherInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchDataMapperInterface
     */
    protected $erpOrderPageSearchDataMapper;

    /**
     * ErpOrderPageSearchPublisher constructor.
     *
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface  $entityManager
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface  $utilEncodingService
     * @param  \FondOfOryx\Zed\ErpOrderPageSearch\Business\Model\ErpOrderPageSearchDataMapperInterface  $erpOrderPageSearchDataMapper
     */
    public function __construct(
        ErpOrderPageSearchEntityManagerInterface $entityManager,
        ErpOrderPageSearchToUtilEncodingServiceInterface $utilEncodingService,
        ErpOrderPageSearchDataMapperInterface $erpOrderPageSearchDataMapper
    ) {
        $this->entityManager = $entityManager;
        $this->utilEncodingService = $utilEncodingService;
        $this->erpOrderPageSearchDataMapper = $erpOrderPageSearchDataMapper;
    }

    /**
     * @param int[] $erpOrderIds
     *
     * @return void
     */
    public function publish(array $erpOrderIds): void
    {
        $fooErpOrderEntities = [];

        $this->storeData($fooErpOrderEntities);
    }

    /**
     * @param \Orm\Zed\ErpOrder\Persistence\Base\FooErpOrder[] $fooErpOrderEntities
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

        $erpOrderPageSearchTransfer = (new ErpOrderPageSearchTransfer())
            ->fromArray($erpOrderData, true)
            ->setData($erpOrderData);

         $erpOrderPageSearchTransfer = $this->addDataAttributes($erpOrderPageSearchTransfer);

        $this->entityManager->createErpOrderPageSearch($erpOrderPageSearchTransfer);
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
            $erpOrderPageSearchTransfer->getData()
        );

        $data = $this->erpOrderPageSearchDataMapper
            ->mapErpOrderDataToSearchData($data);

        $structuredData = $this->utilEncodingService->encodeJson($data);

        return $erpOrderPageSearchTransfer->setData($data)
            ->setStructuredData($structuredData);
    }
}
