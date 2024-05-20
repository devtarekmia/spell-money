<?php

namespace TarekMia\SpellMoney;

class SpellMoney
{
    private $digits;
    private $separators;

    public function __construct()
    {
        // Words for digits and numbers
        $this->digits = [
            0 => "zero",
            1 => "one",
            2 => "two",
            3 => "three",
            4 => "four",
            5 => "five",
            6 => "six",
            7 => "seven",
            8 => "eight",
            9 => "nine",
            10 => "ten",
            11 => "eleven",
            12 => "twelve",
            13 => "thirteen",
            14 => "fourteen",
            15 => "fifteen",
            16 => "sixteen",
            17 => "seventeen",
            18 => "eighteen",
            19 => "nineteen",
            20 => "twenty",
            30 => "thirty",
            40 => "forty",
            50 => "fifty",
            60 => "sixty",
            70 => "seventy",
            80 => "eighty",
            90 => "ninety"
        ];

        // Words for place value
        $this->separators = [
            0 => "",
            1 => "hundred",
            2 => "thousand",
            3 => "lakh",
            4 => "crore"
        ];
    }

    // Converts a number to words
    public function spell($number)
    {
        $words = $this->numberToWords($number);

        if (count($words) > 1 && $words[1] != 'zero' && strlen($words[1]) > 0) {
            $words[0] = str_replace(' and', '', $words[0]);

            if ($words[0] == 'zero' || strlen($words[0]) < 1) {
                return $words[1] . ' paisa';
            }

            return $words[0] . ' taka and ' . $words[1] . ' paisa';
        }

        return $words[0] . ' taka';
    }

    // Converts a number to an array of words for integer and decimal parts
    private function numberToWords($number)
    {
        $number = abs($number);
        $numStr = strval($number);
        $integerPart = intval($number);
        $integerStr = strval($integerPart);

        $decimalPart = false;

        // Check and extract decimal part if exists
        if (preg_match("/\./", $numStr)) {
            $decimalPart = substr(preg_replace('/.*\./', '', $numStr), 0, 2);
            if (strlen($decimalPart) == 1 && $decimalPart[0] != '0') {
                $decimalPart .= '0';
            }
        }

        $integerWords = $this->convertIntegerPart($integerStr);

        if ($integerPart == 0) $integerWords = 'zero';

        if ($decimalPart && intval($decimalPart) > 0) {
            $decimalWords = $this->convertToWords($decimalPart);
            return [$integerWords, trim($decimalWords)];
        }

        return [$integerWords, ''];
    }

    // Converts the integer part of the number to words
    private function convertIntegerPart($integerStr)
    {
        $len = strlen($integerStr);
        $integerStr = strrev($integerStr);
        $inWords = '';

        for ($i = 0; $i < $len; $i += 7) {
            $part = substr($integerStr, $i, 7);
            $level = $this->calculateLevel(strlen($part));
            $odd = (strlen($part) == 4 || strlen($part) == 6);
            $partWords = $this->convertSevenDigitPart(strrev($part), $level, 0, $odd);

            if ($i >= 7) {
                $partWords = str_replace(' and', '', $partWords);
                $inWords = trim($partWords) . ' crore ' . $inWords;
            } else {
                $inWords = trim($partWords) . ' ' . $inWords;
            }
        }

        return trim($inWords);
    }

    // Recursive function to convert a seven-digit segment to words
    private function convertSevenDigitPart($segment, $level, $index, $odd)
    {
        $str = substr($segment, $index, $odd || $level == 1 ? 1 : 2);
        $increment = strlen($str);
        $words = $this->convertToWords($str);

        if ($level > 0) {
            if (intval($str) > 0) {
                $words .= ' ' . $this->separators[$level] . ' ';
            }
            return $words . $this->convertSevenDigitPart($segment, $level - 1, $index + $increment, false);
        }

        if (intval($str) > 0 && strlen($segment) > 2) return 'and ' . $words;
        else return ' ' . $words;
    }

    // Converts a number string to words
    private function convertToWords($numStr)
    {
        $integer = intval($numStr);
        if ($integer == 0) return '';

        if (array_key_exists($integer, $this->digits)) {
            return $this->digits[$integer];
        }

        $tens = intval($integer / 10) * 10;
        $units = $integer % 10;

        return $this->digits[$tens] . ' ' . $this->digits[$units];
    }

    // Calculates the place value level
    private function calculateLevel($len)
    {
        if ($len <= 2) return 0;
        if ($len == 3) return 1;
        if ($len <= 5) return 2;
        if ($len <= 7) return 3;
        return 4;
    }
}
