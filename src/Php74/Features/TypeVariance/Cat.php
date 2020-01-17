<?php

namespace Php74\Features\TypeVariance;

final class Cat extends Animal
{
   public function speak(): string
   {
      return $this->name . " miao";
   }
}
