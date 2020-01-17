<?php

namespace Php74\Features;
/**
 * Class Preloading
 * @package Php74\Features
 *
 * https://wiki.php.net/rfc/preload
 * https://stitcher.io/blog/preloading-in-php-74
 * https://stitcher.io/blog/php-preload-benchmarks
 */
class Preloading extends Feature
{
   public function execute(): void
   {
      $text = <<<EOT
         Si tratta di una feature di basso livello ed è un'aggiunta al core di PHP 7.4 che può comportare miglioramenti significativi delle prestazioni.

         In breve,utilizzando ad esempio un framework, i suoi file devono essere caricati e linkati ad ogni richiesta. Il precaricamento consente al server
         di caricare file PHP in memoria all'avvio e di averli permanentemente disponibili per tutte le richieste successive.

         L'aumento delle prestazioni ha ovviamente un costo: se i sorgenti dei file precaricati vengono modificati, il server deve essere riavviato.
      EOT;

      $this->printOutput([$text], '1) Preloading');
   }

   public static function shortFeatureName(): string
   {
      return 'preload';
   }
}
