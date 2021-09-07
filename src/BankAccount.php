<?php declare(strict_types=1);

class BankAccount
{
    protected int $balance;

    public function __construct()
    {
        $this->balance = 0;
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
     * Return the account balance
     */
    public function getBalance(): int
    {
        return $this->balance;
    }
}
