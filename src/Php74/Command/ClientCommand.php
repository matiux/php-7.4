<?php

namespace Php74\Command;

use Php74\Features\ArrowFunction;
use Php74\Features\Preloading;
use Php74\Features\TypedProperty;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClientCommand extends Command
{
   protected static $defaultName = 'client';

   private array $availableFeature;
   private OutputInterface $output;

   protected function configure()
   {
      $this->availableFeature = [
         'arrow-func',
         'preload',
         'typed'
      ];

      $this
         ->setDescription('PHP 7.4 features client')
         ->setHelp('This command allows you to navigate PHP 7.4 features')
         ->addArgument('feature', InputArgument::REQUIRED, sprintf('Feature name. [%s]', implode(', ', $this->availableFeature)));

   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {
      $this->decorateOutput($output);
      $this->validateInputFeature($input);

      $feature = $input->getArgument('feature');


      switch ($feature) {
         case 'arrow-func':
            $this->handleArrowFunction();
            break;
         case 'preload':
            $this->handlePreloading();
            break;
         case 'typed':
            $this->handleTypedProperty();
            break;
      }

      return 0;
   }

   private function decorateOutput(OutputInterface $output)
   {
      $this->output = $output;
      $outputStyle = new OutputFormatterStyle('green', 'yellow', ['bold', 'blink']);
      $this->output->getFormatter()->setStyle('ok', $outputStyle);
   }

   private function validateInputFeature(InputInterface $input)
   {
      $outputStyle = new OutputFormatterStyle('red', 'yellow', ['bold', 'blink']);

      $this->output->getFormatter()->setStyle('fire', $outputStyle);

      if (!in_array($input->getArgument('feature'), $this->availableFeature)) {
         $this->output->writeln('<fire>Invalid feature</>');
         die();
      }
   }

   private function handleArrowFunction()
   {
      $arrowFunction = new ArrowFunction([3, 4]);

      $this->printOutput($arrowFunction->cube([1, 2]), '1) Basic usage: cube');
      $this->printOutput([$arrowFunction->scope()], '2) Parent scope');
      $this->printOutput($arrowFunction->thisScope(), '3) This scope');
      $this->printOutput([$arrowFunction->signature()], '4) Signature');
      $this->printOutput([$arrowFunction->nested()], '5) Nested');
   }

   private function printOutput(array $results, string $headerName)
   {
      $table = new Table($this->output);

      $table
         ->setHeaders([[new TableCell($headerName, ['colspan' => count($results)])]])
         ->setRows([$results]);

      $table->render();
   }

   private function handlePreloading()
   {
      $preloading = new Preloading();

      $this->printOutput([$preloading->execute()], '1) Preloading');
   }

   private function handleTypedProperty()
   {
      $typedProperty = new TypedProperty();

      //$typedProperty->uninitialized();

      ob_start();
      var_dump($typedProperty->oldDeclaration());

      $this->printOutput([ob_get_clean()], '1) Assignment without type');
      $this->printOutput([$typedProperty->text()], '2) Info');
   }
}
