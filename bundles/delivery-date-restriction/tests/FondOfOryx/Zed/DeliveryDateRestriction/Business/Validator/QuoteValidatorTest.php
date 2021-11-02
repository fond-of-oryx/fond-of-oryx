<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator;

use Codeception\Test\Unit;
use DateTime;
use Exception;
use FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension\DefineDeliveryDatePermissionPlugin;
use FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $permissionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Business\Validator\QuoteValidator
     */
    protected $quoteValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->permissionFacadeMock = $this->getMockBuilder(DeliveryDateRestrictionToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidator = new QuoteValidator(
            $this->permissionFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $idCompanyUser = 1;
        $deliveryDates = [QuoteValidator::DELIVERY_DATE_EARLIEST];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(DefineDeliveryDatePermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(false);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getDeliveryDates')
            ->willReturn($deliveryDates);

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
        } catch (Exception $exception) {
            static::fail();
        }
    }

    /**
     * @return void
     */
    public function testValidateWithPermissionToDefineCustomDeliveryDates(): void
    {
        $idCompanyUser = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(DefineDeliveryDatePermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(true);

        $this->quoteTransferMock->expects(static::never())
            ->method('getDeliveryDates');

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
        } catch (Exception $exception) {
            static::fail();
        }
    }

    /**
     * @return void
     */
    public function testValidateWithoutPermissionToDefineCustomDeliveryDates(): void
    {
        $idCompanyUser = 1;
        $deliveryDates = [QuoteValidator::DELIVERY_DATE_EARLIEST, (new DateTime())->format('Y-m-d')];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('requireCompanyUser')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireIdCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(DefineDeliveryDatePermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(false);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getDeliveryDates')
            ->willReturn($deliveryDates);

        try {
            $this->quoteValidator->validate($this->quoteTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }
}
