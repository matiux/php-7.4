<?php

namespace Php74\Features;

class SpreadOperator extends Feature
{
   public static function shortFeatureName(): string
   {
      return 'spread';
   }

   public function execute()
   {
      $this->printOutput([$this->php56ArgumentUnpacking(...[1, 9, 10])], 'Php 5.6 arguments unpacking');
      $this->printOutput($this->php74ArgumentUnpackingInArray([1, 2], [3, 4]), 'Php 7.4 spread operator');
   }

   public function php56ArgumentUnpacking(int $a, int $b, int $c): int
   {
      return $a + $b + $c;
   }

   public function php74ArgumentUnpackingInArray(array $a, array $b): array
   {
      return [0, ...$a, ...$b, 5, 6];
   }
}
