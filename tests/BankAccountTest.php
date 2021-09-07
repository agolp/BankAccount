<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BankAccountTest extends TestCase
{
    public function testGetEmptyAccountBalance(): void
    {
        $account = new BankAccount();
        $this->assertEquals(0, $account->getBalance());
    }

    public function testBalancePostCredit(): void
    {
        $account = new BankAccount();
        $account->credit(100);
        $this->assertEquals(100, $account->getBalance());
    }
}
