<?php

namespace Php74\Features;

use Symfony\Component\Console\Output\OutputInterface;
use TypeError;

/**
 * Class ArrowFunction
 * @package Php74
 *
 * Le arrow functions, dette anche "short closures", consentono la scrittura di funzioni meno dettagliate in una riga.
 *
 * https://wiki.php.net/rfc/arrow_functions_v2
 * https://stitcher.io/blog/short-closures-in-php
 */
class ArrowFunction extends Feature
{
   private array $numbers = [1, 2];

   public static function create(OutputInterface $output)
   {
      return parent::create($output);
   }

   public static function shortFeatureName(): string
   {
      return 'arrow';
   }

   public function execute()
   {
      $this->printOutput($this->cube([1, 2]), '1) Basic usage: cube');
      $this->printOutput([$this->scope()], '2) Parent scope');
      $this->printOutput($this->thisScope(), '3) This scope');
      $this->printOutput([$this->signature()], '4) Signature');
      $this->printOutput([$this->nested()], '5) Nested');
   }

   public function cube(array $inputNumbers): array
   {
      return array_map(fn(int $number) => $number * $number * $number, $inputNumbers);
   }

   public function scope(): int
   {
      /**
       * In precedenza, dovevamo usare la keyword `use` per utilizzare una variabile dall'ambito padre.
       *
       * $y = 1;
       *
       * $fn = function ($x) use ($y) {
       *    return $x + $y;
       * };
       *
       * Ora non più:
       */

      $b = 1;

      $f = fn($a) => $a + $b;

      return $f(9);
   }

   public function thisScope(): array
   {
      /**
       * Quanto sopra vale anche per $this
       */
      return array_map(fn(int $number) => $number * $number * $number, $this->numbers);
   }

   /**
    * Purtroppo ancora non si può :(
    */
   //fn getNumbers(): array => $this->numbers;


   public function signature(): string
   {
      /**
       * Questo è completamente nuovo in PHP e ci consente di definire il tipo di funzione,
       * la variabile e il valore che la funzione sta restituendo
       *
       * Da php 7.1 è possibile indicare che un parametro potrebbe essere null - a mio avvio non una buona pratica.
       */

      $f = fn(?int $a): int => $a;

      /**
       * Viene generato un errore se la firma non viene rispettata.
       * L'errore può essere rilevato utilizzando il tipo TypeError
       */

      try {
         $f("foo");

      } catch (TypeError $e) {
         return $e->getMessage();
      }

      return '';
   }


   public function nested(): int
   {
      $var = 6;

      /**
       * Equivale a:
       * return (fn() => function () use ($var) {
       *    return $var;
       * })()();
       */

      return (fn() => fn() => $var)()();
   }
}
