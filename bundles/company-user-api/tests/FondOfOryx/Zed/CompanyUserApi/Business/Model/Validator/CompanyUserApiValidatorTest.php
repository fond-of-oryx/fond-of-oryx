<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUserApiValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator
     */
    protected $companyUserApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiValidator = new CompanyUserApiValidator();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        static::assertCount(0, $this->companyUserApiValidator->validate($this->apiRequestTransferMock));
    }
}
