<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator;

use FondOfOryx\Zed\DeliveryDateRestriction\Business\Exception\CustomDeliveryDatesNotAllowedException;
use FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension\DefineDeliveryDatePermissionPlugin;
use FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidator implements QuoteValidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface
     */
    protected $permissionFacade;

    /**
     * @param \FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface $permissionFacade
     */
    public function __construct(DeliveryDateRestrictionToPermissionFacadeInterface $permissionFacade)
    {
        $this->permissionFacade = $permissionFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \FondOfOryx\Zed\DeliveryDateRestriction\Business\Exception\CustomDeliveryDatesNotAllowedException
     *
     * @return void
     */
    public function validate(QuoteTransfer $quoteTransfer): void
    {
        $companyUserTransfer = $quoteTransfer->requireCompanyUser()
            ->getCompanyUser();

        $companyUserTransfer->requireFkCompany();

        if ($this->permissionFacade->can(DefineDeliveryDatePermissionPlugin::KEY, $companyUserTransfer->getFkCompany())) {
            return;
        }

        $deliveryDates = $quoteTransfer->getDeliveryDates();

        if (count($deliveryDates) === 1 && $deliveryDates[0] === 'earliest-date') {
            return;
        }

        throw new CustomDeliveryDatesNotAllowedException('Not enough permission to define delivery dates.');
    }
}
