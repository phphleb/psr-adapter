## Adapter for using PSR in the HLEB2 framework

Framework [repository](https://github.com/phphleb/hleb/)

[![HLEB2](https://img.shields.io/badge/HLEB-2-darkcyan)](https://github.com/phphleb/hleb) ![PHP](https://img.shields.io/badge/PHP-^8.2-blue) [![License: MIT](https://img.shields.io/badge/License-MIT%20(Free)-brightgreen.svg)](https://github.com/phphleb/hleb/blob/master/LICENSE)

Install using Composer:
 ```bash
composer require phphleb/psr-adapter
 ```
--------------------------

 ```php
use Hleb\Static\Converter;

$psrContainer = Converter::toPsr11Container();

$psrCache = Converter::toPsr16SimpleCache();

$psrLog = Converter::toPsr3Logger();

 ```


