<?php

namespace Php74\Features\TypeVariance\Covariance;

use Php74\Features\TypeVariance\Dog;

class DogShelter implements AnimalShelter
{
   public function adopt(string $name): Dog // invece di restituire Animal, può restituire il sotto tipo Dog
   {
      return new Dog($name);
   }
}
