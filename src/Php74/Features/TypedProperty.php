<?php

namespace Php74\Features;

use Php74\Features\Misc\Email;

/**
 * Class TypedProperty
 * @package Php74\Features
 *
 * https://wiki.php.net/rfc/typed_properties_v2
 * https://stitcher.io/blog/typed-properties-in-php-74
 */
class TypedProperty extends Feature
{
   protected static string $foo = 'bar';
   public string $address;
   public Email $email;
   public ?int $number = 1;
   public array $numbers;
   public $oldAddress;

   public static function shortFeatureName(): string
   {
      return 'typed';
   }

   public function uninitialized()
   {
      /**
       * Il seguente codice è valido.
       * Anche se il valore di $address non è una stringa dopo aver creato un oggetto TypedProperty,
       * PHP genererà un errore solo quando si accede a $address.
       * Come puoi leggere dal messaggio di errore, esiste un nuovo tipo di "stato variabile": uninitialized.
       */

      return $this->address;
   }

   public function execute()
   {
      $this->printOutput([$this->text()], '1) Info');

      $this->printOutput([$this->getErrorFromOutputBuffer(fn() => $this->oldDeclaration())], '2) Assignment without type');
      $this->printOutput([$this->casting()], '3) Casting');
   }

   private function oldDeclaration()
   {
      /**
       * Dato che $oldAddress non ha un tipo, il suo valore di inizializzazione è NULL. Tuttavia, i tipi possono
       * essere nullable, quindi non è possibile determinare se è stata impostata una proprietà nullable digitata
       * o semplicemente dimenticata.
       * Ecco perché è stato aggiunto "uninitialized".
       */
      return $this->oldAddress;
   }

   private function casting()
   {
      $class = new class('7') {
         public int $i;

         public function __construct(string $i)
         {
            $this->i = $i;
         }
      };

      return gettype($class->i);
   }

   private function text(): string
   {
      return <<<EOT

         1) Non è possibile leggere da proprietà non inizializzate, poiché ciò comporterà un errore irreversibile.
         2) Poiché lo stato uninitialized viene verificato quando si accede a una proprietà, è possibile creare un oggetto
            con una proprietà uninitialized, anche se il suo tipo è non-nullable.
         3) È possibile scrivere su una proprietà non inizializzata prima di leggere da essa.
         4) L'uso di unset() su una proprietà tipizzata la renderà uninitialized, mentre l'unsetting di una proprietà non tipizzata la renderà NULL.
         5) Per ora i tipi sulle proprietà, funzionano solo nelle calssi.
         6) PHP, essendo un linguaggio dinamico, cercherà di forzare o convertire i tipi ogni volta che può.
            In questo esempio PHP proverà a convertire quella stringa automaticamente:

            function coerce(int \$i) { /* … */ }

            coerce('1'); // int(1)

            La stessa cosa vale per le proprietà delle classi:

            class Bar
            {
               public int \$i;

               __construct(string \$i) { \$this->\$i = \$i }
            }

            \$bar = new Bar;

            \$bar->i = '1'; // int(1)

            Se non ti piace questo comportamento, puoi disabilitarlo dichiarando i tipi come strict:

            declare(strict_types=1);
            \$bar = new Bar;
            \$bar->i = '1';

            Fatal error: Uncaught TypeError: Typed property Bar::\$i must be int, string used
      EOT;
   }
}

