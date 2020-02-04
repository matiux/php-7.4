<?php

namespace Php74\Command;

use Php74\Features\ArrowFunction;
use Php74\Features\FeaturesRegistry;
use Php74\Features\ForeignFunctionInterface\ForeignFunction;
use Php74\Features\NullCoalescing;
use Php74\Features\Preloading;
use Php74\Features\SpreadOperator;
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
   private FeaturesRegistry $featuresRegistry;

   protected function configure()
   {
      $this->availableFeature = [
         ArrowFunction::shortFeatureName(),
         Preloading::shortFeatureName(),
         TypedProperty::shortFeatureName(),
         Covariance::shortFeatureName(),
         Contravariance::shortFeatureName(),
         NullCoalescing::shortFeatureName(),
         SpreadOperator::shortFeatureName(),
         ForeignFunction::shortFeatureName(),
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

      $this->buildFeaturesRegistry($output);

      $this->featuresRegistry->get($input->getArgument('feature'))->execute();

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
         $this->output->writeln('<fire>Invalid feature</fire>');
         die();
      }
   }

   private function buildFeaturesRegistry(OutputInterface $output)
   {
      $this->featuresRegistry = new FeaturesRegistry();
      $this->featuresRegistry->add(ArrowFunction::create($output));
      $this->featuresRegistry->add(Preloading::create($output));
      $this->featuresRegistry->add(TypedProperty::create($output));
      $this->featuresRegistry->add(Covariance::create($output));
      $this->featuresRegistry->add(Contravariance::create($output));
      $this->featuresRegistry->add(NullCoalescing::create($output));
      $this->featuresRegistry->add(SpreadOperator::create($output));
      $this->featuresRegistry->add(ForeignFunction::create($output));
   }
}
