<?php

namespace Php74\Features\TypeVariance;

use Php74\Features\TypeVariance\Contravariance\AnimalFood;

abstract class Animal
{
   protected string $name;

   public function __construct(string $name)
   {
      $this->name = $name;
   }

   public function eat(AnimalFood $food): string
   {
      return $this->name . " eats " . get_class($food);
   }

   abstract public function speak(): string;
}
