<?php

namespace Forestry\Log\Test;

use Forestry\Log\{DirectoryException, FileException, Log};
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class ExceptionTest
 *
 * Test case for all exceptions thrown by the package.
 *
 * @package Forestry\Log
 * @subpackage Forestry\Log\Test
 */
class ExceptionTest extends TestCase {
  private string $testFile = 'forestry-log-test.log';

  /**
   * Clean possibly previous generated test log file.
   */
  function setUp(): void {
    if (file_exists(__DIR__ . '/tmp/' . $this->testFile)) {
      unlink(__DIR__ . '/tmp/' . $this->testFile);
    }
  }

  function testThrowsExceptionWhenDirectoryDoesNotExist() {
    $this->expectException(DirectoryException::class);
    new Log(__DIR__ . '/tmp/test/' . $this->testFile);
  }

  function testThrowsExceptionWhenDirectoryDoesntHaveWritePermissions() {
    $this->expectException(DirectoryException::class);
    new Log('/root/' . $this->testFile);
  }

  function testThrowsExceptionWhenHandleCantBeOpened() {
    $this->expectException(FileException::class);
    @new Log(__DIR__ . '/tmp/.');
  }

  function testThrowsExceptionOnUndefinedLogLevel() {
    $this->expectException(InvalidArgumentException::class);
    new Log(__DIR__ . '/tmp/' . $this->testFile, 100);
  }

  function testLogThrowsExceptionOnUndefinedLogLevel() {
    $this->expectException(InvalidArgumentException::class);
    $logger = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $logger->log(100, 'What level is this?');
  }
}
