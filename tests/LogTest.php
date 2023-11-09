<?php

namespace Forestry\Log\Test;

use Forestry\Log\Log;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class LogTest extends TestCase {
  /**
   * @var string
   */
  private $testFile = 'forestry-log-test.log';

  /**
   * Clean possibly previous generated test log file.
   */
  function setUp(): void {
    if (file_exists(__DIR__ . '/tmp/' . $this->testFile)) {
      unlink(__DIR__ . '/tmp/' . $this->testFile);
    }
  }

  function testCreateInstance() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertInstanceOf(Log::class, $log);
    $this->assertFileExists(__DIR__ . '/tmp/' . $this->testFile);
  }

  function testLogWithoutContext() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->log(LogLevel::DEBUG, 'A log message');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} DEBUG A log message/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogWithContext() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->log(LogLevel::DEBUG, 'Hello {name}', array('name' => 'World'));

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} DEBUG Hello World/', $content);
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogEmergency() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->emergency('This is an emergency');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} EMERGENCY This is an emergency/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogAlert() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->alert('This is an alert');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} ALERT This is an alert/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogCritical() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->critical('This is a critical situation');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} CRITICAL This is a critical situation/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogError() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->error('This is an error');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} ERROR This is an error/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogWarning() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->warning('This is a warning');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} WARNING This is a warning/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogNotice() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->notice('This is just a notice');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} NOTICE This is just a notice/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogInfo() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->info('This is an information');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} INFO This is an information/',
      $content
    );
  }

  /**
   * @depends testLogWithoutContext
   */
  function testLogDebug() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->debug('This is a debug message');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} DEBUG This is a debug message/',
      $content
    );
  }

  function testSetDateFormat() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->setDateFormat('c');
    $log->debug('Set another date format');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+\d{2}:\d{2} DEBUG Set another date format/',
      $content
    );
  }

  function testSetLogFormat() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->setLogFormat('[{date}|{level}] {message}');
    $log->debug('Set another log format');

    $content = file_get_contents(__DIR__ . '/tmp/' . $this->testFile);
    $this->assertMatchesRegularExpression(
      '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\|DEBUG\] Set another log format/',
      $content
    );
  }

  function testSetLogThreshold() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->setLogThreshold(LogLevel::INFO);
    $log->debug('Set log threshold to info');

    $this->assertStringEqualsFile(__DIR__ . '/tmp/' . $this->testFile, '');
  }

  function testGetLogThreshold() {
    $log = new Log(__DIR__ . '/tmp/' . $this->testFile);
    $log->setLogThreshold(LogLevel::NOTICE);
    $level = $log->getLogThreshold();

    $this->assertEquals($level, LogLevel::NOTICE);
  }
}
