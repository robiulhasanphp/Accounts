<?php

declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentTable;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class PaymentTableTest extends TestCase
{
    protected ?PaymentTable $Payment = null;

    protected array $fixtures = [];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Payment') ? [] : ['className' => PaymentTable::class];
        $this->Payment = TableRegistry::getTableLocator()->get('Payment', $config);
    }

    public function tearDown(): void
    {
        unset($this->Payment);
        parent::tearDown();
    }

    public function testInitialize(): void
    {
        $this->assertSame('vouchers', $this->Payment->getTable());
        $this->assertTrue($this->Payment->hasAssociation('Basicdata'));
        $this->assertTrue($this->Payment->hasAssociation('Ledgerstype'));
        $this->assertTrue($this->Payment->hasAssociation('Ledgers'));
        $this->assertTrue($this->Payment->hasAssociation('Voucherdtl'));
    }

    public function testGetVoucherdtl(): void
    {
        $query = $this->Payment->getVoucherdtl();
        $this->assertInstanceOf(Query::class, $query);
        $this->assertSame(['Voucherdtl'], $query->getContain());
    }
}
