<?php

namespace Php74\Features\TypeVariance\Covariance;

use Php74\Features\TypeVariance\Animal;

interface AnimalShelter
{
   public function adopt(string $name): Animal;
}
