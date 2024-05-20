<?php

namespace TarekMia\SpellMoney\Tests;

use PHPUnit\Framework\TestCase;
use TarekMia\SpellMoney\SpellMoney;

class SpellMoneyTest extends TestCase
{
    protected $spellMoney;

    protected function setUp(): void
    {
        $this->spellMoney = new SpellMoney();
    }

    public function testCanSpellCrore()
    {
        $result = $this->spellMoney->spell(10000000);
        $this->assertEquals('one crore taka', $result);
    }

    public function testCanSpellLakh()
    {
        $result = $this->spellMoney->spell(100000);
        $this->assertEquals('one lakh taka', $result);
    }

    public function testCanSpellThousand()
    {
        $result = $this->spellMoney->spell(1000);
        $this->assertEquals('one thousand taka', $result);
    }

    public function testCanSpellHundred()
    {
        $result = $this->spellMoney->spell(100);
        $this->assertEquals('one hundred taka', $result);
    }

    public function testCanSpellOneTaka()
    {
        $result = $this->spellMoney->spell(1);
        $this->assertEquals('one taka', $result);
    }

    public function testCanSpellZeroTaka()
    {
        $result = $this->spellMoney->spell(0);
        $this->assertEquals('zero taka', $result);
    }

    public function testCanDetermineAndSpellPaisa()
    {
        $result = $this->spellMoney->spell(0.25);
        $this->assertEquals('twenty five paisa', $result);

        $result = $this->spellMoney->spell(1.25);
        $this->assertEquals('one taka and twenty five paisa', $result);
    }

    public function testCanSpellBigValues()
    {
        $result = $this->spellMoney->spell(4582456225.54);
        $this->assertEquals('four hundred fifty eight crore twenty four lakh fifty six thousand two hundred twenty five taka and fifty four paisa', $result);
    }
}
