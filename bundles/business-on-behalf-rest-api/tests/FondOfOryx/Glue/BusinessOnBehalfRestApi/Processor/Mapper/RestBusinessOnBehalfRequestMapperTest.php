<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestBusinessOnBehalfRequestMapperTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapper
     */
    protected RestBusinessOnBehalfRequestMapper $restBusinessOnBehalfRequestMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restBusinessOnBehalfRequestAttributesTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestMapper = new RestBusinessOnBehalfRequestMapper();
    }

    /**
     * @return void
     */
    public function testFromRestBusinessOnBehalfRequestAttributes(): void
    {
        $data = [
            'company_user_reference' => 'Foo',
        ];

        $this->restBusinessOnBehalfRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $restBusinessOnBehalfRequestMapperTransfer = $this->restBusinessOnBehalfRequestMapper->fromRestBusinessOnBehalfRequestAttributes(
            $this->restBusinessOnBehalfRequestAttributesTransferMock,
        );

        static::assertEquals(
            $data['company_user_reference'],
            $restBusinessOnBehalfRequestMapperTransfer->getCompanyUserReference(),
        );
    }
}
