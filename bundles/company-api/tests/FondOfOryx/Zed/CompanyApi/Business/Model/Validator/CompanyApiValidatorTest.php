<?php


namespace FondOfOryx\Zed\CompanyApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;

class CompanyApiValidatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Business\Model\Validator\CompanyApiValidator
     */
    protected $companyApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApiValidator = new CompanyApiValidator();
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

        $errors = $this->companyApiValidator->validate($this->apiDataTransferMock);

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

        $errors = $this->companyApiValidator->validate($this->apiDataTransferMock);

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

        $errors = $this->companyApiValidator->validate($this->apiDataTransferMock);

        static::assertIsArray($errors);
        static::assertArrayHasKey('name', $errors);
        static::assertCount(1, $errors['name']);
    }
}
