<?php

namespace Php74\Features;

/**
 * Class NullCoalescing
 * @package Php74\Features
 *
 * https://www.php.net/manual/en/migration70.new-features.php
 * https://stitcher.io/blog/new-in-php-74#null-coalescing-assignment-operator-rfc
 * https://wiki.php.net/rfc/null_coalesce_equal_operator
 */
class NullCoalescing extends Feature
{
   public function execute()
   {
      $v1 = $this->php70NullCoalescingV1(['name' => 'Matteo']);
      $v2 = $this->php70NullCoalescingV2([]);
      $v2a = $this->php70NullCoalescingV2a(['name' => 'Matteo']);
      $v3 = $this->php70NullCoalescingV3([]);
      $v4 = $this->nullCoalescingAssignmentOperator(['name' => 'Matteo']);

      $this->printOutput([$v1], '1) Null identification in php 7.0 - V1');
      $this->printOutput([$v2], '2) Null identification in php 7.0 - V2');
      $this->printOutput([$v2a], '3) Null identification in php 7.0 - V2a');
      $this->printOutput([$v3], '4) Null identification in php 7.0 - V3');
      $this->printOutput([$v4], '4) Null identification in php 7.4');
   }

   public function php70NullCoalescingV1(array $data): string
   {
      if (isset($data['name'])) {

         $name = $data['name'];

      } else {

         $name = 'nobody';
      }

      return $name;
   }

   public function php70NullCoalescingV2(array $data): string
   {
      return isset($data['name']) ? $data['name'] : 'nobody';
   }

   public function php70NullCoalescingV2a(array $data): string
   {
      /**
       * Se fossimo certi che la chiave `name` esiste
       */
      return $data['name'] ?: 'nobody';
   }

   public function php70NullCoalescingV3(array $data): string
   {
      // Recupera il valore di $data['name'] e restituisce 'nobody' se non esiste.
      return $data['name'] ?? 'nobody';
   }

   public function nullCoalescingAssignmentOperator(array $data)
   {
      return $data['name'] ??= 'nobody';
   }
}
