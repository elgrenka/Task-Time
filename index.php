<?php

interface TimeToWordConvertingInterface {
    public function convert(int $hours, int $minutes): string;
}

class TimeToWordConverter implements TimeToWordConvertingInterface {

    public function convert(int $hours, int $minutes): string {
        if ($minutes == 0) {
            return $this->getHourWord($hours) . '.';
        } elseif ($minutes == 30) {
            return 'Половина ' . $this->getHourWord($hours + 1);
        } elseif ($minutes == 45) {
            return 'Без пятнадцати ' . $this->getHourWord($hours + 1);
        } elseif ($minutes == 15) {
            return 'Четверть ' . $this->getHourWord($hours + 1);
        } elseif ($minutes < 30) {
            return $this->getMinuteWord($minutes) . ' после ' . $this->getHourWord($hours);
        } else {
            return $this->getMinuteWord(60 - $minutes) . ' до ' . $this->getHourWord($hours + 1);
        }
    }

    private function getHourWord(int $hours): string {
        $hourWords = [
            1 => 'один', 2 => 'два', 3 => 'три', 4 => 'четыре', 5 => 'пять', 6 => 'шесть',
            7 => 'семь', 8 => 'восемь', 9 => 'девять', 10 => 'десять', 11 => 'одиннадцать', 0 => 'двенадцать'
        ];

        $hours = $hours % 12;

        return $hourWords[$hours];
    }

    private function getMinuteWord(int $minutes): string {
        if ($minutes == 0) {
            return '';
        } elseif ($minutes == 1) {
            return 'одна минута';
        } elseif ($minutes == 2) {
            return 'две минуты';
        } elseif ($minutes >= 3 && $minutes <= 4 || $minutes >= 21 && $minutes <= 24 || $minutes >= 31 && $minutes <= 34 || $minutes >= 41 && $minutes <= 44 || $minutes >= 51 && $minutes <= 54) {
            return $this->numbersToWords($minutes) . ' минуты';
        } else {
            return $this->numbersToWords($minutes) . ' минут';
        }
    }

    private function numbersToWords(int $number): string {
        $words = '';
        $ones = ['', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', 'десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'];
        $tens = ['', '', 'двадцать', 'тридцать', 'сорок', 'пятьдесят'];
        if ($number < 20) {
            $words = $ones[$number];
        } elseif ($number < 100) {
            $words = $tens[intdiv($number, 10)];
            if ($number % 10 > 0) {
                $words .= ' ' . $ones[$number % 10];
            }
        }
        return $words;
    }
}


$converter = new TimeToWordConverter();
echo $converter->convert(9, 02);



