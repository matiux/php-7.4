<?php

namespace Php74\Features\TypeVariance\Covariance;

use Php74\Features\Feature;

/**
 * Class Covariance
 * @package Php74\Features\TypeVariance\Covariance
 *
 * https://wiki.php.net/rfc/covariant-returns-and-contravariant-parameters
 * https://stitcher.io/blog/new-in-php-74#typed-properties-rfc
 * https://stitcher.io/blog/liskov-and-type-safety
 * https://stitcher.io/blog/liskov-and-type-safety#benefits-of-the-lsp
 */
class Covariance extends Feature
{
   public function execute()
   {
      $micio = (new CatShelter)->adopt('Ciopper');
      $cane = (new DogShelter)->adopt("Fido");

      $this->printOutput([$micio->speak()], '1) Micio');
      $this->printOutput([$cane->speak()], '2) Cane');
      $this->printOutput([$this->text()], '3) Info');
   }

   private function text(): string
   {
      return <<<EOT
         La covarianza consente al metodo figlio di restituire un tipo più
         specifico rispetto al tipo di ritorno del metodo padre.

         La covarianza è probabilmente più facile da capire ed è direttamente correlata al principio di
         sostituzione di Liskov (LSP - SOLID)

         If S is a subtype of T, then objects of type T may be replaced with objects of type S

         Usando l'esempio sopra, diciamo che riceviamo un oggetto `AnimalShelter`, e quindi vogliamo usarlo invocando
         il suo metodo`adop()`. Sappiamo che restituisce un oggetto "Animal", e indipendentemente da cosa sia esattamente
         quell'oggetto, cioè se si tratta di un "Cat" o un "Dog", possiamo trattarli allo stesso modo. Pertanto,
         è OK specializzare il tipo restituito: conosciamo almeno l'interfaccia comune di qualsiasi cosa che può
         essere restituita e possiamo trattare tutti questi valori allo stesso modo.
      EOT;
   }
}
