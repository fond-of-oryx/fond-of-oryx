<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Generated\Shared\Transfer\JellyfishOrderTotalsTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderMapper implements JellyfishOrderMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface
     */
    protected $jellyfishOrderAddressMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface
     */
    protected $jellyfishOrderExpenseMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface
     */
    protected $jellyfishOrderDiscountMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface
     */
    protected $jellyfishOrderPaymentMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface
     */
    protected $jellyfishOrderTotalsMapper;

    /**
     * @var string
     */
    protected $systemCode;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface[]
     */
    protected $jellyfishOrderExpanderPostMapPlugins;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface $jellyfishOrderAddressMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface $jellyfishOrderExpenseMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface $jellyfishOrderDiscountMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface $jellyfishOrderPaymentMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface $jellyfishOrderTotalsMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface[] $jellyfishOrderExpanderPostMapPlugins
     * @param string $systemCode
     */
    public function __construct(
        JellyfishOrderAddressMapperInterface $jellyfishOrderAddressMapper,
        JellyfishOrderExpenseMapperInterface $jellyfishOrderExpenseMapper,
        JellyfishOrderDiscountMapperInterface $jellyfishOrderDiscountMapper,
        JellyfishOrderPaymentMapperInterface $jellyfishOrderPaymentMapper,
        JellyfishOrderTotalsMapperInterface $jellyfishOrderTotalsMapper,
        array $jellyfishOrderExpanderPostMapPlugins,
        string $systemCode
    ) {
        $this->jellyfishOrderAddressMapper = $jellyfishOrderAddressMapper;
        $this->jellyfishOrderExpenseMapper = $jellyfishOrderExpenseMapper;
        $this->jellyfishOrderDiscountMapper = $jellyfishOrderDiscountMapper;
        $this->jellyfishOrderPaymentMapper = $jellyfishOrderPaymentMapper;
        $this->jellyfishOrderTotalsMapper = $jellyfishOrderTotalsMapper;
        $this->jellyfishOrderExpanderPostMapPlugins = $jellyfishOrderExpanderPostMapPlugins;
        $this->systemCode = $systemCode;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function fromSalesOrder(SpySalesOrder $salesOrder): JellyfishOrderTransfer
    {
        $jellyfishOrderTransfer = new JellyfishOrderTransfer();

        $jellyfishOrderTransfer->setId($salesOrder->getIdSalesOrder())
            ->setReference($salesOrder->getOrderReference())
            ->setCustomerReference($salesOrder->getCustomerReference())
            ->setEmail($salesOrder->getEmail())
            ->setLocale($salesOrder->getLocale()->getLocaleName())
            ->setPriceMode($salesOrder->getPriceMode())
            ->setCurrency($salesOrder->getCurrencyIsoCode())
            ->setStore($salesOrder->getStore())
            ->setSystemCode($this->systemCode)
            ->setPayments($this->mapSalesOrderToPayments($salesOrder))
            ->setBillingAddress($this->mapSalesOrderToBillingAddress($salesOrder))
            ->setShippingAddress($this->mapSalesOrderToShippingAddress($salesOrder))
            ->setExpenses($this->mapSalesOrderToExpenses($salesOrder))
            ->setDiscounts($this->mapSalesOrderToDiscounts($salesOrder))
            ->setTotals($this->mapSalesOrderToTotals($salesOrder))
            ->setCreatedAt($salesOrder->getCreatedAt()->format('Y-m-d H:i:s'));

        return $this->expandOrderTransfer($jellyfishOrderTransfer, $salesOrder);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    protected function expandOrderTransfer(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        foreach ($this->jellyfishOrderExpanderPostMapPlugins as $jellyfishOrderExpanderPostMapPlugin) {
            $jellyfishOrderTransfer = $jellyfishOrderExpanderPostMapPlugin->expand($jellyfishOrderTransfer, $salesOrder);
        }

        return $jellyfishOrderTransfer;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \ArrayObject
     */
    protected function mapSalesOrderToPayments(SpySalesOrder $salesOrder): ArrayObject
    {
        $jellyfishOrderPayments = new ArrayObject();

        foreach ($salesOrder->getOrdersJoinSalesPaymentMethodType() as $salesPayment) {
            $jellyfishOrderPayment = $this->jellyfishOrderPaymentMapper->fromSalesPayment($salesPayment);

            $jellyfishOrderPayments->append($jellyfishOrderPayment);
        }

        return $jellyfishOrderPayments;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \ArrayObject
     */
    protected function mapSalesOrderToExpenses(SpySalesOrder $salesOrder): ArrayObject
    {
        $jellyfishOrderExpenses = new ArrayObject();

        foreach ($salesOrder->getExpenses() as $salesExpense) {
            $jellyfishOrderExpense = $this->jellyfishOrderExpenseMapper->fromSalesExpense($salesExpense);

            $jellyfishOrderExpenses->append($jellyfishOrderExpense);
        }

        return $jellyfishOrderExpenses;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    protected function mapSalesOrderToBillingAddress(SpySalesOrder $salesOrder): JellyfishOrderAddressTransfer
    {
        return $this->jellyfishOrderAddressMapper->fromSalesOrderAddress($salesOrder->getBillingAddress());
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    protected function mapSalesOrderToShippingAddress(SpySalesOrder $salesOrder): JellyfishOrderAddressTransfer
    {
        return $this->jellyfishOrderAddressMapper->fromSalesOrderAddress($salesOrder->getShippingAddress());
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \ArrayObject
     */
    protected function mapSalesOrderToDiscounts(SpySalesOrder $salesOrder): ArrayObject
    {
        $jellyfishOrderDiscounts = new ArrayObject();

        foreach ($salesOrder->getDiscounts() as $salesDiscount) {
            $jellyfishOrderDiscount = $this->jellyfishOrderDiscountMapper->fromSalesDiscount($salesDiscount);

            $jellyfishOrderDiscounts->append($jellyfishOrderDiscount);
        }

        return $jellyfishOrderDiscounts;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTotalsTransfer
     */
    protected function mapSalesOrderToTotals(SpySalesOrder $salesOrder): JellyfishOrderTotalsTransfer
    {
        return $this->jellyfishOrderTotalsMapper->fromSalesOrder($salesOrder);
    }
}
