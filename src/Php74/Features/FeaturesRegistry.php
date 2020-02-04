<?php

namespace Php74\Features;

use LogicException;

class FeaturesRegistry
{
   /** @var Feature[][] */
   protected array $features = [];
   protected bool $frozen = false;

   public function add(Feature $feature, $priority = null)
   {
      if ($this->frozen) {
         throw new LogicException('The registry is frozen. You cannot add anything.');
      }
      if (is_null($priority)) {
         $priority = 100;
      }

      $this->features[$priority][] = $feature;

      return $this;
   }

   public function get(string $shortCode): Feature
   {
      $this->ensureExtractorsAreSorted();

      foreach ($this->features as $features) {
         foreach ($features as $feature) {
            if ($feature->supports($shortCode)) {
               return $feature;
            }
         }
      }

      throw new InvalidArgumentException($shortCode);
   }

   private function ensureExtractorsAreSorted(): void
   {
      if (!$this->frozen) {
         ksort($this->features);
         $this->frozen = true;
      }
   }
}
