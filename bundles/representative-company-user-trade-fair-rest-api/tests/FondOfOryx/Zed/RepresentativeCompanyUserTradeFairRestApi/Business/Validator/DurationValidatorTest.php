<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class DurationValidatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiConfig $configMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface;
     */
    protected DurationValidatorInterface $durationValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->durationValidator = new DurationValidator($this->configMock);
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn('1970-01-01');

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn('1970-01-07');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxDurationForRepresentation')
            ->willReturn(7);

        $this->assertEquals(
            true,
            $this->durationValidator->validate($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidateWithExceededDuration(): void
    {
        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn('1970-01-01');

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn('1970-01-07');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxDurationForRepresentation')
            ->willReturn(2);

        $this->assertEquals(
            false,
            $this->durationValidator->validate($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidateWithMissingStartDate(): void
    {
        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn(null);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn('1970-01-07');

        $this->assertEquals(
            false,
            $this->durationValidator->validate($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock),
        );
    }
}
