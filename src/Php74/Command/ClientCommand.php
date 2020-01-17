<?php

namespace Php74\Command;

use Php74\Features\ArrowFunction;
use Php74\Features\NullCoalescing;
use Php74\Features\Preloading;
use Php74\Features\TypedProperty;
use Php74\Features\TypeVariance\Contravariance\Contravariance;
use Php74\Features\TypeVariance\Covariance\Covariance;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
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
         'arrow',
         'preload',
         'typed',
         'cova',
         'contrava',
         'null'
      ];

      $this
         ->setDescription('PHP 7.4 features client')
         ->setHelp('This command allows you to navigate PHP 7.4 features')
         ->addArgument('feature', InputArgument::REQUIRED, sprintf('Feature name. [%s]', implode(', ', $this->availableFeature)));

   }

   protected function execute(InputInterface $input, OutputInterface $output)
   {
      system('clear');

      $this->decorateOutput($output);
      $this->validateInputFeature($input);

      $feature = $input->getArgument('feature');

      switch ($feature) {
         case 'arrow':
            ArrowFunction::create($output)->execute();
            break;
         case 'preload':
            Preloading::create($output)->execute();
            break;
         case 'typed':
            TypedProperty::create($output)->execute();
            break;
         case 'cova':
            Covariance::create($output)->execute();
            break;
         case 'contrava':
            Contravariance::create($output)->execute();
            break;
         case 'null':
            NullCoalescing::create($output)->execute();
            break;
      }

      return 0;
   }

   private function decorateOutput(OutputInterface $output): void
   {
      $this->output = $output;
      $outputStyle = new OutputFormatterStyle('green', 'yellow', ['bold', 'blink']);
      $this->output->getFormatter()->setStyle('ok', $outputStyle);
   }

   private function validateInputFeature(InputInterface $input): void
   {
      $outputStyle = new OutputFormatterStyle('red', 'yellow', ['bold', 'blink']);

      $this->output->getFormatter()->setStyle('fire', $outputStyle);

      if (!in_array($input->getArgument('feature'), $this->availableFeature)) {
         $this->output->writeln('<fire>Invalid feature</>');
         die();
      }
   }
}
