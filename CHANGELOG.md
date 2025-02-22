# Changelog

All Notable changes to `log` will be documented in this file.

## 2.0.0 - 2023-11-09

### Changed
- Updated psr/log implementation to 3.0, added support for PHP 8.

## 1.0.0 - 2015-05-02

### Added
- Added DirectoryException, FileException and own InvalidArgumentException.
- Added factories for each log level.

### Changed
- Changed parameter of the constructor. File path and name are not separated anymore.

## 0.3.0 - 2015-02-13

Implementation of PSR-3 introducing breaking changes.

### Added
- Psr\Log (PSR-3) implementation
- setLogThreshold() and getLogThreshold() methods

### Changed
- Reformat code according to the PSR-2 specs

### Fixed
- Fixed instructions and examples in README.md

### Removed
- Removed setLevel() and getLevel() methods

## 0.2.0.1 - 2015-02-02

No functionality added. Changes in the project structure and namespaces.

## 0.2.0 - 2014-09-23

### Removed
- Support for PHP 5.3

## 0.1.0 - 2013-06-05

First release.
