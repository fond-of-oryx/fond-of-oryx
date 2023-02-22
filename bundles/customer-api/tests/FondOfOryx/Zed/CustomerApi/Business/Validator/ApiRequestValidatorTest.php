<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ApiRequestValidatorTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\ApiRequestTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiRequestTransfer|MockObject $apiRequestTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiDataTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiDataTransfer|MockObject $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidator
     */
    protected ApiRequestValidator $apiRequestValidator;

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

        $this->apiRequestValidator = new ApiRequestValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $transferData = ['email' => 'max@xam.de'];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->apiRequestValidator->validate($this->apiRequestTransferMock);

        static::assertCount(0, $errors);
    }

    /**
     * @return void
     */
    public function testValidateWithInvalidEmail(): void
    {
        $transferData = ['email' => 'xx@'];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->apiRequestValidator->validate($this->apiRequestTransferMock);

        static::assertCount(1, $errors);
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

        $errors = $this->apiRequestValidator->validate($this->apiRequestTransferMock);

        static::assertCount(1, $errors);
    }
}
