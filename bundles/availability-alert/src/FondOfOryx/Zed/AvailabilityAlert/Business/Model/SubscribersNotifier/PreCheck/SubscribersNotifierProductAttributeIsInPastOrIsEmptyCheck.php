<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck;

use DateTimeImmutable;
use DateTimeInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use function array_key_exists;

class SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheck implements SubscribersNotifierProductAttributeIsInPastOrIsEmptyCheckInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface
     */
    protected $availabilityAlertToProduct;

    /**
     * @var string
     */
    protected string $productAttributeForDateCheck;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface $availabilityAlertToProduct
     * @param string $productAttributeForDateCheck
     */
    public function __construct(
        AvailabilityAlertToProductInterface $availabilityAlertToProduct,
        string $productAttributeForDateCheck
    ) {
        $this->availabilityAlertToProduct = $availabilityAlertToProduct;
        $this->productAttributeForDateCheck = $productAttributeForDateCheck;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function checkHasProductAttributeIsInPastOrIsEmpty(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): bool
    {
        $productAbstractTransfer = $this->getProductAbstractTransfer($availabilityAlertSubscriptionTransfer);

        if ($productAbstractTransfer === null) {
            return false;
        }

        if (!$this->hasProductAttribute($productAbstractTransfer)) {
            return true;
        }

        return $this->isDateTimeInPastOrEqual($this->getProductAttribute($productAbstractTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    protected function hasProductAttribute(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        return array_key_exists($this->productAttributeForDateCheck, $productAbstractTransfer->getAttributes())
            && $productAbstractTransfer->getAttributes()[$this->productAttributeForDateCheck] !== ''
            && $productAbstractTransfer->getAttributes()[$this->productAttributeForDateCheck] !== null;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \DateTimeInterface
     */
    protected function getProductAttribute(ProductAbstractTransfer $productAbstractTransfer): DateTimeInterface
    {
        return new DateTimeImmutable($productAbstractTransfer->getAttributes()[$this->productAttributeForDateCheck]);
    }

    /**
     * @param \DateTimeInterface $compareDateTime
     *
     * @return bool
     */
    protected function isDateTimeInPastOrEqual(DateTimeInterface $compareDateTime): bool
    {
        return $compareDateTime <= new DateTimeImmutable();
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer|null
     */
    protected function getProductAbstractTransfer(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): ?ProductAbstractTransfer
    {
        return $this->availabilityAlertToProduct->findProductAbstractById($availabilityAlertSubscriptionTransfer->getFkProductAbstract());
    }
}
