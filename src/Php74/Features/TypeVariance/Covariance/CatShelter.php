<?php

namespace Php74\Features\TypeVariance\Covariance;

use Php74\Features\TypeVariance\Cat;

class CatShelter implements AnimalShelter
{
   public function adopt(string $name): Cat // invece di restituire Animal, può restituire il sotto tipo Cat
   {
      return new Cat($name);
   }
}
