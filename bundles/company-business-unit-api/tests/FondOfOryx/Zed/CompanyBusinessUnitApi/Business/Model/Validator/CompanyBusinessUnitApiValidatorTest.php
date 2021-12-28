<?php


namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyBusinessUnitApiValidatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new CompanyBusinessUnitApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $transferData = ['name' => 'Lorem Ipsum'];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->validator->validate($this->apiDataTransferMock);

        static::assertIsArray($errors);
        static::assertArrayNotHasKey('name', $errors);
    }

    /**
     * @return void
     */
    public function testValidateWithEmptyString(): void
    {
        $transferData = ['name' => ' '];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->validator->validate($this->apiDataTransferMock);

        static::assertIsArray($errors);
        static::assertArrayHasKey('name', $errors);
        static::assertCount(1, $errors['name']);
    }

    /**
     * @return void
     */
    public function testValidateWithEmptyTransferData(): void
    {
        $transferData = [];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($transferData);

        $errors = $this->validator->validate($this->apiDataTransferMock);

        static::assertIsArray($errors);
        static::assertArrayHasKey('name', $errors);
        static::assertCount(1, $errors['name']);
    }
}
