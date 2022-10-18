<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;

class AttributesMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restOneTimePasswordLoginLinkRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper\AttributesMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock = $this->getMockBuilder(RestOneTimePasswordLoginLinkRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new AttributesMapper();
    }

    /**
     * @return void
     */
    public function testMapRequestAttributesToTransfer(): void
    {
        $this->restOneTimePasswordLoginLinkRequestAttributesTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->mapper->mapRequestAttributesToTransfer($this->restOneTimePasswordLoginLinkRequestAttributesTransferMock);
    }
}
