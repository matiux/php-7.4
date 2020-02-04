<?php

namespace Php74\Features\ForeignFunctionInterface;

final class Pripper
{
   private static $ffi = null;

   function __construct()
   {
      if (is_null(self::$ffi)) {
         self::$ffi = \FFI::scope("PRIPPER");
      }
   }

   function GoPripper($string)
   {
      return self::$ffi->GoPripper($string);
   }

   function CPripper($string)
   {
      return self::$ffi->CPripper($string);
   }
}
