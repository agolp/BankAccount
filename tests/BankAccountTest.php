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

    public function testBalancePostDebit(): void
    {
        $account = new BankAccount(100);
        $account->debit(51);
        $this->assertEquals(49, $account->getBalance());
    }

    public function testCannotDebitMoreThanBalance(): void
    {
        $account = new BankAccount(50);
        $this->expectException(BankAccountException::class);
        $account->debit(100);
    }

    public function testTransferBetweenAccounts(): void
    {
        $a1 = new BankAccount(50);
        $a2 = new BankAccount(20);
        $a1->transfer($a2, 15);
        $this->assertEquals(35, $a1->getBalance());
        $this->assertEquals(35, $a2->getBalance());
    }

    public function testCannotTransferMoreThanBalance(): void
    {
        $a1 = new BankAccount(50);
        $a2 = new BankAccount(20);
        $this->expectException(BankAccountException::class);
        $a1->transfer($a2, 80);
        $this->assertEquals(50, $a1->getBalance());
        $this->assertEquals(20, $a2->getBalance());
    }

    public function testAmountCannotBeNegative(): void
    {
        $account = new BankAccount();
        $this->expectException(BankAccountException::class);
        $account->credit(-5);
        $account = new BankAccount();
        $this->expectException(BankAccountException::class);
        $account->debit(-1);
    }

    public function testDebitWithAuthorizedBuffer(): void
    {
        $account = new BankAccount(0, 10);
        $account->debit(5);
        $this->assertEquals(-5, $account->getBalance());
    }

    public function testTransferWithAuthorizedBuffer(): void
    {
        $a1 = new BankAccount(50, 50);
        $a2 = new BankAccount(20);
        $a1->transfer($a2, 80);
        $this->assertEquals(-30, $a1->getBalance());
        $this->assertEquals(100, $a2->getBalance());
    }

    public function testCannotTransferMoreThanBalanceAndBuffer(): void
    {
        $a1 = new BankAccount(50, 30);
        $a2 = new BankAccount(20);
        $this->expectException(BankAccountException::class);
        $a1->transfer($a2, 100);
        $this->assertEquals(50, $a1->getBalance());
        $this->assertEquals(20, $a2->getBalance());
    }
}
