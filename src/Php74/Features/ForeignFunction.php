<?php

namespace Php74\Features;

use FFI;

class ForeignFunction extends Feature
{
   private FFI $ffiPripperGo;
   private FFI $ffiPripperC;

   public static function shortFeatureName(): string
   {
      return 'ffi';
   }

   public function execute()
   {
      $outputCdef = $this->cdef();
      $outputGoCall = $this->goCall();
      $outputCCall = $this->CCall();

      $this->printOutput([$outputCdef], '1) C def');
      $this->printOutput([$outputGoCall], '2) Go call');
      $this->printOutput([$outputCCall], '3) C call');
   }

   private function cdef(): string
   {
      $ffi = FFI::cdef("

         typedef char buffer[50];

         int sprintf(char *str, const char *format, ...);

         ", // this is a regular C declaration
         "libc.so.6");



      $output=$ffi->new("buffer");

      // call C's printf()
      $ffi->sprintf($output, "Hello %s!", "world");

      return FFI::string($output);
   }

   private function goCall(): string
   {
      $output = $this->ffiPripperGo->GoPripper('matteo');

      return FFI::string($output);
   }

   private function CCall(): string
   {
      $output = $this->ffiPripperC->CPripper('qwerty');

      return FFI::string($output);
   }

   protected function bootstrap(): void
   {
      parent::bootstrap();

      $this->ffiPripperGo = FFI::load(getcwd() . '/pripper/go_pripper.header');
      $this->ffiPripperC = FFI::load(getcwd() . '/pripper/c_pripper.h');
   }
}
