<?php

namespace Forestry\Log\Test;

use Forestry\Log\{
  DebugLogger,
  InfoLogger,
  NoticeLogger,
  WarningLogger,
  ErrorLogger,
  CriticalLogger,
  AlertLogger,
  EmergencyLogger
};
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

/**
 * Class FactoryTest
 *
 * Test case for the factory method.
 *
 * @package Forestry\Log
 * @subpackage Forestry\Log\Test
 */
class FactoryTest extends TestCase {
  /**
   * @var string
   */
  private $testFile = __DIR__ . '/tmp/forestry-log-test.log';

  function testDebugLogger() {
    $factory = new DebugLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::DEBUG);
  }

  function testInfoLogger() {
    $factory = new InfoLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::INFO);
  }

  function testNoticeLogger() {
    $factory = new NoticeLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::NOTICE);
  }

  function testWarningLogger() {
    $factory = new WarningLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::WARNING);
  }

  function testErrorLogger() {
    $factory = new ErrorLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::ERROR);
  }

  function testCriticalLogger() {
    $factory = new CriticalLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::CRITICAL);
  }

  function testAlertLogger() {
    $factory = new AlertLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::ALERT);
  }

  function testEmergencyLogger() {
    $factory = new EmergencyLogger();
    $logger = $factory->create($this->testFile);

    $this->assertEquals($logger->getLogThreshold(), LogLevel::EMERGENCY);
  }
}
