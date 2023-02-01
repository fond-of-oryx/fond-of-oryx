<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUnitAddressApiValidatorTest extends Unit
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
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidator
     */
    protected $companyUnitAddressApiValidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiValidator = new CompanyUnitAddressApiValidator();
    }

    /**
     * @return void
     */
    public function testValidateWithErrors(): void
    {
        $data = [];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        static::assertCount(
            4,
            $this->companyUnitAddressApiValidator->validate($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $data = [
            'address1' => 'address1',
            'zip_code' => 'zip_code',
            'fk_country' => 'fk_country',
            'iso2_code' => 'iso2_code',
        ];

        $this->apiRequestTransferMock->expects(static::atLeastOnce())
            ->method('getApiDataOrFail')
            ->willReturn($this->apiDataTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        static::assertCount(
            0,
            $this->companyUnitAddressApiValidator->validate($this->apiRequestTransferMock),
        );
    }
}
