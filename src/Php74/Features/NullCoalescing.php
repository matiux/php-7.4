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
final class NullCoalescing extends Feature
{
   public static function shortFeatureName(): string
   {
      return 'null';
   }

   public function execute(): void
   {
      $v1 = $this->phpXNullCoalescingV1();
      $v2 = $this->phpXNullCoalescingV2();
      $v2a = $this->phpXNullCoalescingV2a();
      $v3 = $this->php70NullCoalescing();
      $v4 = $this->nullCoalescingAssignmentOperator();

      $this->printOutput([$v1], '1) Null identification in php 7.0 - V1');
      $this->printOutput([$v2], '2) Null identification in php 7.0 - V2');
      $this->printOutput([$v2a], '3) Null identification in php 7.0 - V2a');
      $this->printOutput([$v3], '4) Null identification in php 7.0 - V3');
      $this->printOutput([$v4], '5) Null identification in php 7.4');
   }

   public function phpXNullCoalescingV1(): string
   {
      $data = ['name' => 'Matteo'];

      if (isset($data['name'])) {

         $name = $data['name'];

      } else {

         $name = 'nobody';
      }

      return $name;
   }

   public function phpXNullCoalescingV2(): string
   {
      $data = [];

      return isset($data['name']) ? $data['name'] : 'nobody';
   }

   public function phpXNullCoalescingV2a(): string
   {
      $data = ['name' => 'Matteo'];

      /**
       * Se fossimo certi che la chiave `name` esiste
       */
      return $data['name'] ?: 'nobody';
   }

   public function php70NullCoalescing(): string
   {
      $data = [];

//      Equivalente:
//      if (isset($_GET['user'])) {
//         return $_GET['user'];
//      } else {
//         return 'nobody';
//      }

      // Recupera il valore di $data['name'] e restituisce 'nobody' se non esiste.
      $data['name'] = $data['name'] ?? 'nobody';

      return $data['name'];
   }

   public function nullCoalescingAssignmentOperator()
   {
      $data = ['name' => 'Matteo'];

//      Equivalente:
//      if (!isset($data['name'])) {
//         $data['name'] = 'nobody';
//      }

      return $data['name'] ??= 'nobody';
   }
}
