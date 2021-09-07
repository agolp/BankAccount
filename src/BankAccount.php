<?php declare(strict_types=1);

class BankAccount
{
    protected int $balance;

    public function __construct(int $balance = 0)
    {
        $this->balance = $balance;
    }

    /**
     * Credit the account with the supplied amount
     */
    public function credit(int $amount): BankAccount
    {
        $this->balance += $amount;

        return $this;
    }

    /**
     * Debit the account with the supplied amount
     */
    public function debit(int $amount): BankAccount
    {
        if ($amount > $this->balance) {
            throw new BankAccountException('Insufficient funds in bank account');
        }
        $this->balance -= $amount;

        return $this;
    }

    /**
     * Return the account balance
     */
    public function getBalance(): int
    {
        return $this->balance;
    }
}
