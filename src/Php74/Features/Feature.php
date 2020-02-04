<?php

namespace Php74\Features;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Feature
{
   private OutputInterface $output;

   public function __construct(OutputInterface $output)
   {
      $this->output = $output;
   }

   public static function create(OutputInterface $output)
   {
      $obj = new static($output);

      $obj->bootstrap();

      return $obj;
   }

   protected function bootstrap(): void
   {
   }

   public function supports(string $shortcode): bool
   {
      return $shortcode === static::shortFeatureName();
   }

   abstract public static function shortFeatureName(): string;

   abstract public function execute(): void;

   protected function printOutput(array $results, string $headerName)
   {
      $table = new Table($this->output);

      $table
         ->setHeaders([[new TableCell($headerName, ['colspan' => count($results)])]])
         ->setRows([$results]);

      $table->render();
   }

   protected function getErrorFromOutputBuffer(callable $f): string
   {
      ob_start();

      var_dump($f());

      return ob_get_clean();
   }
}
