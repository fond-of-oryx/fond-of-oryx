<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapper;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class JellyfishOrderAddressMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface
     */
    protected $jellyfishOrderAddressMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Sales\Persistence\SpySalesOrderAddress
     */
    protected $spySalesOrderAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Country\Persistence\SpyCountry
     */
    protected $spyCountryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesOrderAddressMock = $this->getMockBuilder(SpySalesOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCountryMock = $this->getMockBuilder(SpyCountry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderAddressMapper = new JellyfishOrderAddressMapper([]);
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItem(): void
    {
        $data = [
            'id_sales_order_address' => 1,
            'first_name' => 'Max',
            'last_name' => 'Mustermann',
            'address1' => 'strasse 12',
            'address2' => '',
            'address3' => '',
            'city' => 'Berlin',
            'zip_code' => '10119',
            'phone' => '555-55551',
            'country' => [
                'iso2_code' => 'DE',
            ],
        ];

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn($data['id_sales_order_address']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getFirstName')
            ->willReturn($data['first_name']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getLastName')
            ->willReturn($data['last_name']);

        $this->spySalesOrderAddressMock->expects($this->atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->spyCountryMock);

        $this->spyCountryMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($data['country']['iso2_code']);

        $jellyfishOrderAddressTransfer = $this->jellyfishOrderAddressMapper->fromSalesOrderAddress($this->spySalesOrderAddressMock);

        static::assertEquals($data['id_sales_order_address'], $jellyfishOrderAddressTransfer->getId());
        static::assertEquals($data['first_name'], $jellyfishOrderAddressTransfer->getName1());
        static::assertEquals($data['last_name'], $jellyfishOrderAddressTransfer->getName2());
        static::assertEquals($data['address1'], $jellyfishOrderAddressTransfer->getAddress1());
        static::assertEquals($data['address2'], $jellyfishOrderAddressTransfer->getAddress2());
        static::assertEquals($data['address3'], $jellyfishOrderAddressTransfer->getAddress3());
        static::assertEquals($data['city'], $jellyfishOrderAddressTransfer->getCity());
        static::assertEquals($data['zip_code'], $jellyfishOrderAddressTransfer->getZipCode());
        static::assertEquals($data['phone'], $jellyfishOrderAddressTransfer->getPhone());
        static::assertEquals($data['country']['iso2_code'], $jellyfishOrderAddressTransfer->getCountry());
    }
}
