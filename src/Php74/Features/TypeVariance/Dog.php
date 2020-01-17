<?php

namespace Php74\Features\TypeVariance;

use Php74\Features\TypeVariance\Contravariance\Food;

final class Dog extends Animal
{
   public function speak(): string
   {
      return $this->name . " bau";
   }

   public function eat(Food $food): string
   {
      return $this->name . " nom noms " . get_class($food);
   }
}
