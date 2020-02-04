PHP 7.4
========================

## Sviluppo

#### Entrare nel container PHP per lo sviluppo
```
./dc up -d
./dc enter
composer install
./console client <feature_name>
```

## Lista delle features:
* [Arrow functions](https://stitcher.io/blog/short-closures-in-php)
    - Console command: arrow
    - Classe php: ArrowFunction.php
* [Preloading](https://stitcher.io/blog/preloading-in-php-74)
    - Console command: preload
* [Typed properties](https://stitcher.io/blog/typed-properties-in-php-74)
    - Console command: typed
    - Classe php: TypedProperty.php
* [Covariance](https://www.php.net/manual/en/language.oop5.variance.php)
    - Console command: cova
    - Classe php: Covariance.php
* [Contravariance](https://www.php.net/manual/en/language.oop5.variance.php)
    - Console command: contrava
    - Classe php: Contravariance.php 
* [Null coalescing assignment operator](https://stitcher.io/blog/new-in-php-74#null-coalescing-assignment-operator-rfc)
    - Console command: null
    - Classe php: NullCoalescing.php
* [Spread operator for array](https://wiki.php.net/rfc/spread_operator_for_array)
    - Console command: spread
    - Classe php: SpreadOperator.php
* [Foreign Function Interface](https://wiki.php.net/rfc/ffi)
    - Console command: ffi
    - Classe php: ForeignFunction.php
