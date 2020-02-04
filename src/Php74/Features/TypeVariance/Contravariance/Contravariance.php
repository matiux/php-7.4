<?php

namespace Php74\Features\TypeVariance\Contravariance;

use Php74\Features\Feature;
use Php74\Features\TypeVariance\Covariance\CatShelter;
use Php74\Features\TypeVariance\Covariance\DogShelter;

/**
 * Class Contravariance
 * @package Php74\Features\TypeVariance\Covariance
 *
 * https://wiki.php.net/rfc/covariant-returns-and-contravariant-parameters
 * https://stitcher.io/blog/new-in-php-74#typed-properties-rfc
 * https://stitcher.io/blog/liskov-and-type-safety
 * https://stitcher.io/blog/liskov-and-type-safety#benefits-of-the-lsp
 */
final class Contravariance extends Feature
{
   public static function shortFeatureName(): string
   {
      return 'contrava';
   }

   public function execute(): void
   {
      $micio = (new CatShelter)->adopt("Ciopper");
      $croccantini = new AnimalFood();

      $cane = (new DogShelter)->adopt("Fido");
      $banana = new Food();

      $this->printOutput([$this->text()], '1) Info');

      $this->printOutput([$micio->eat($croccantini)], '2) Micio mangia AnimalFood: croccantini');
      $this->printOutput([$cane->eat($banana)], '3) Cane mangia Food: banana');
   }

   private function text(): string
   {
      return <<<EOT
         La controvarianza, consente a un tipo di parametro di essere meno specifico in
         un metodo figlio rispetto a quello del suo genitore.

         La controvarianza è leggermente più complicata. È molto legato alla praticità di aumentare la
         flessibilità di un metodo. Usando di nuovo l'esempio degli animali, il metodo "base" `eat()` accetta
         un tipo specifico di cibo; tuttavia, un animale "particolare" potrebbe voler supportare una gamma
         più ampia di tipi di alimenti. Forse aggiunge funzionalità al metodo originale che gli consente di consumare
         qualsiasi tipo di cibo, non solo quello destinato agli animali.
         Il metodo "base" in "Animal" implementa già la funzionalità permettendogli di consumare alimenti
         specializzati per animali. Il metodo prioritario nella classe `Dog` può verificare se il parametro è
         di tipo `AnimalFood`, e semplicemente invocare `parent::eat(\$food)`.
         Se il parametro non è invece tipo specializzato, può eseguire un'elaborazione aggiuntiva o addirittura
         completamente diversa di quel parametro (senza violare la firma originale), poiché "ancora" gestisce il
         tipo specializzato, ma anche di più. Ecco perché è anche strettamente legato alla sostituzione di Liskov:

         i client possono ancora passare un tipo di cibo specializzato all' "Animale" senza sapere esattamente se
         si tratta di un "Cat" o "Dog".
      EOT;
   }
}
