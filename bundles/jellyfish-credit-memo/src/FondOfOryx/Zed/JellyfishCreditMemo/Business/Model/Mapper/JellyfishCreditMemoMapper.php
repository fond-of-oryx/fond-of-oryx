<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper;

use ArrayObject;
use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoCustomerTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoItemTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoPriceTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class JellyfishCreditMemoMapper implements JellyfishCreditMemoMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface $salesFacade
     */
    public function __construct(JellyfishCreditMemoToSalesFacadeInterface $salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoTransfer
     */
    public function mapCreditMemoTransferToJellyfishCreditMemoTransfer(
        CreditMemoTransfer $creditMemoTransfer
    ): JellyfishCreditMemoTransfer {
        $orderTransfer = $this->salesFacade->findOrderByIdSalesOrder($creditMemoTransfer->getFkSalesOrder());

        $jellyfishCreditMemo = new JellyfishCreditMemoTransfer();
        $jellyfishCreditMemo->setId($creditMemoTransfer->getIdCreditMemo())
            ->setSystemCode($this->getSystemCode($creditMemoTransfer))
            ->setExternalReference($creditMemoTransfer->getExternalReference())
            ->setCreditMemoReference($creditMemoTransfer->getCreditMemoReference())
            ->setOrderReference($creditMemoTransfer->getOrderReference())
            ->setFirstName($creditMemoTransfer->getFirstName())
            ->setLastName($creditMemoTransfer->getLastName())
            ->setEmail($creditMemoTransfer->getEmail())
            ->setCustomer($this->mapOrderTransferToJellyfishCreditMemoCustomerTransfer($orderTransfer))
            ->setItems($this->getJellyfishCreditMemoItems($creditMemoTransfer->getItems()))
            ->setLocale($creditMemoTransfer->getLocale()->getLocaleName())
            ->setStore($creditMemoTransfer->getStore())
            ->setCreatedAt($this->convertDate($creditMemoTransfer->getCreatedAt()))
            ->setUpdatedAt($this->convertDate($creditMemoTransfer->getUpdatedAt()))
            ->setTransactionId($creditMemoTransfer->getTransactionId())
            ->setErrorMessage($creditMemoTransfer->getErrorMessage())
            ->setErrorCode((int)$creditMemoTransfer->getErrorCode())
            ->setInProgress($creditMemoTransfer->getInProgress())
            ->setProcessed($creditMemoTransfer->getProcessed())
            ->setWasRefundSuccessful($creditMemoTransfer->getWasRefundSuccessful())
            ->setRefundedTotal($this->mapTotalRefundAmount($creditMemoTransfer))
            ->setChargedTotal($this->mapTotalChargeAmount($creditMemoTransfer))
            ->setPaidTotal($this->mapTotalPaidAmount($creditMemoTransfer))
            ->setProcessedAt($this->convertDate((string)$creditMemoTransfer->getProcessedAt()))
            ->setTaxIncluded($creditMemoTransfer->getTaxIncluded())
            ->setState($this->getState($creditMemoTransfer));

        return $jellyfishCreditMemo;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return string|null
     */
    protected function getState(CreditMemoTransfer $creditMemoTransfer): ?string
    {
        $state = $creditMemoTransfer->getState();
        if (array_key_exists($state, CreditMemoConstants::STATE_MAPPING)) {
            return $state;
        }

        $state = array_search($state, CreditMemoConstants::STATE_MAPPING);
        if ($state !== null && $state !== false) {
            return $state;
        }

        return null;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $items
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\JellyfishCreditMemoItemTransfer>
     */
    protected function getJellyfishCreditMemoItems(ArrayObject $items): ArrayObject
    {
        $jellyfishCreditMemoItems = new ArrayObject();

        if ($items->count() === 0) {
            return $jellyfishCreditMemoItems;
        }

        foreach ($items as $itemTransfer) {
            $jellyfishCreditMemoItems->append($this->mapItemTransferToJellyfishCreditMemoItem($itemTransfer));
        }

        return $jellyfishCreditMemoItems;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoItemTransfer
     */
    protected function mapItemTransferToJellyfishCreditMemoItem(
        ItemTransfer $itemTransfer
    ): JellyfishCreditMemoItemTransfer {
        $jellyfishCreditMemoItemTransfer = new JellyfishCreditMemoItemTransfer();
        $jellyfishCreditMemoItemTransfer->setName($itemTransfer->getName());
        $jellyfishCreditMemoItemTransfer->setSku($itemTransfer->getSku());
        $jellyfishCreditMemoItemTransfer->setQuantity($itemTransfer->getQuantity());

        return $jellyfishCreditMemoItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoCustomerTransfer
     */
    protected function mapOrderTransferToJellyfishCreditMemoCustomerTransfer(
        OrderTransfer $orderTransfer
    ): JellyfishCreditMemoCustomerTransfer {
        $jellyfishCreditMemoCustomerTransfer = new JellyfishCreditMemoCustomerTransfer();
        $customer = $orderTransfer->getCustomer();
        if ($customer !== null) {
            $jellyfishCreditMemoCustomerTransfer->setFirstName($customer->getFirstName());
            $jellyfishCreditMemoCustomerTransfer->setLastName($customer->getLastName());
            $jellyfishCreditMemoCustomerTransfer->setSalutation($customer->getSalutation());
            $jellyfishCreditMemoCustomerTransfer->setExternalReference($customer->getCustomerReference());
            $jellyfishCreditMemoCustomerTransfer->setEmail($customer->getEmail());
        }

        return $jellyfishCreditMemoCustomerTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return string
     */
    protected function getSystemCode(CreditMemoTransfer $creditMemoTransfer): string
    {
        if ($creditMemoTransfer->getStore() === null) {
            return '';
        }

        return substr($creditMemoTransfer->getStore(), 0, strpos($creditMemoTransfer->getStore(), '_'));
    }

    /**
     * @param string $dateString
     *
     * @return string|false
     */
    protected function convertDate(string $dateString)
    {
        return date('Y-m-d H:i:s', strtotime($dateString));
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoPriceTransfer
     */
    protected function mapTotalRefundAmount(CreditMemoTransfer $creditMemoTransfer): JellyfishCreditMemoPriceTransfer
    {
        $amount = $creditMemoTransfer->getRefundedAmount();
        $taxAmount = $creditMemoTransfer->getRefundedTaxAmount();

        if ($creditMemoTransfer->getHasGiftCards()) {
            $amount = $creditMemoTransfer->getTotalAmount();
            $taxAmount = $creditMemoTransfer->getTotalTaxAmount();
        }
        $priceTransfer = new JellyfishCreditMemoPriceTransfer();
        $priceTransfer
            ->setAmount($amount)
            ->setTaxAmount($taxAmount);

        return $priceTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoPriceTransfer
     */
    protected function mapTotalChargeAmount(CreditMemoTransfer $creditMemoTransfer): JellyfishCreditMemoPriceTransfer
    {
        $priceTransfer = new JellyfishCreditMemoPriceTransfer();
        $priceTransfer
            ->setAmount($creditMemoTransfer->getChargeAmount())
            ->setTaxAmount($creditMemoTransfer->getChargeTaxAmount());

        return $priceTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoPriceTransfer
     */
    protected function mapTotalPaidAmount(CreditMemoTransfer $creditMemoTransfer): JellyfishCreditMemoPriceTransfer
    {
        $priceTransfer = new JellyfishCreditMemoPriceTransfer();
        $priceTransfer
            ->setAmount($creditMemoTransfer->getTotalAmount())
            ->setTaxAmount($creditMemoTransfer->getTotalTaxAmount());

        return $priceTransfer;
    }
}
