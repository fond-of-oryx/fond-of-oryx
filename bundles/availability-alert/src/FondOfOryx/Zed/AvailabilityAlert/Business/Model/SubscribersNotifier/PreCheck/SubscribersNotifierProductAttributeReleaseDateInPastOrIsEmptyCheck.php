<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck;

use DateTimeImmutable;
use DateTimeInterface;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use function array_key_exists;

class SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheck implements SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheckInterface
{
    protected const PRODUCT_ATTRIBUTE_RELEASE_DATE = 'release_date';

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface
     */
    protected $availabilityAlertToProduct;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface $availabilityAlertToProduct
     */
    public function __construct(AvailabilityAlertToProductInterface $availabilityAlertToProduct)
    {
        $this->availabilityAlertToProduct = $availabilityAlertToProduct;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function checkHasProductAttributeReleaseDateInPastOrIsEmpty(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): bool
    {
        $productAbstractTransfer = $this->getProductAbstractTransfer($availabilityAlertSubscriptionTransfer);
        if ($productAbstractTransfer === null) {
            return false;
        }

        if (!$this->hasProductAttributeReleaseDate($productAbstractTransfer)) {
            return true;
        }

        return $this->isDateTimeInPastOrEqual($this->getProductAttributeReleaseDate($productAbstractTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    protected function hasProductAttributeReleaseDate(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        return array_key_exists(static::PRODUCT_ATTRIBUTE_RELEASE_DATE, $productAbstractTransfer->getAttributes())
            && $productAbstractTransfer->getAttributes()[static::PRODUCT_ATTRIBUTE_RELEASE_DATE] !== ''
            && $productAbstractTransfer->getAttributes()[static::PRODUCT_ATTRIBUTE_RELEASE_DATE] !== null;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \DateTimeInterface
     */
    protected function getProductAttributeReleaseDate(ProductAbstractTransfer $productAbstractTransfer): DateTimeInterface
    {
        return new DateTimeImmutable($productAbstractTransfer->getAttributes()[static::PRODUCT_ATTRIBUTE_RELEASE_DATE]);
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
