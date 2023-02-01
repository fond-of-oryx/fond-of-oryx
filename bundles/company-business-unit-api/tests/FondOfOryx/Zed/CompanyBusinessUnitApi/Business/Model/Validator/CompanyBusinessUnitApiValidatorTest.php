<?php


namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyBusinessUnitApiValidatorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator
     */
    protected $companyBusinessUnitApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiValidator = new CompanyBusinessUnitApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $transferData = ['name' => 'Lorem Ipsum'];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->companyBusinessUnitApiValidator->validate($this->apiRequestTransferMock);

        static::assertCount(0, $errors);
    }

    /**
     * @return void
     */
    public function testValidateWithEmptyString(): void
    {
        $transferData = ['name' => ' '];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->companyBusinessUnitApiValidator->validate($this->apiRequestTransferMock);

        static::assertCount(0, $errors);
    }

    /**
     * @return void
     */
    public function testValidateWithEmptyTransferData(): void
    {
        $transferData = [];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->companyBusinessUnitApiValidator->validate($this->apiRequestTransferMock);

        static::assertCount(1, $errors);
    }
}
