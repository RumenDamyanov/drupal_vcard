<?php

declare(strict_types=1);

namespace Drupal\vcard_generator\Tests;

use Drupal\vcard_generator\VCardGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Test class for VCardGenerator.
 *
 * @category Test
 * @package Drupalvcard_GeneratorTests
 */
class VCardGeneratorTest extends TestCase {

  /**
   * Test vCard generation with minimal required fields.
   *
   * @return void
   */
  public function testCreateVcardMinimal() {
    $generator = new VCardGenerator();
    $vcard = $generator->createVcard(
      [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
      ]
    );
    // Check if the vCard contains the expected fields.
    $this->assertStringContainsString('BEGIN:VCARD', $vcard);
    $this->assertStringContainsString('FN:John Doe', $vcard);
    $this->assertStringContainsString('EMAIL:john.doe@example.com', $vcard);
    $this->assertStringContainsString('END:VCARD', $vcard);
  }

  /**
   * Test vCard generation with empty input.
   *
   * @return void
   */
  public function testCreateVcardEmpty() {
    $generator = new VCardGenerator();
    $vcard = $generator->createVcard([]);
    $this->assertStringContainsString('BEGIN:VCARD', $vcard);
    $this->assertStringContainsString('END:VCARD', $vcard);
  }

  /**
   * Test vCard generation with all supported fields.
   *
   * @return void
   */
  public function testCreateVcardFullFields() {
    $generator = new VCardGenerator();
    $vcard = $generator->createVcard([
      'first_name' => 'Alice',
      'last_name' => 'Smith',
      'email' => 'alice.smith@example.com',
          // Add more fields if supported by VCardGenerator.
    ]
    );
    $this->assertStringContainsString('FN:Alice Smith', $vcard);
    $this->assertStringContainsString('EMAIL:alice.smith@example.com', $vcard);
    $this->assertStringContainsString('BEGIN:VCARD', $vcard);
    $this->assertStringContainsString('END:VCARD', $vcard);
  }

  /**
   * Test vCard generation with some missing fields.
   *
   * @return void
   */
  public function testCreateVcardWithMissingFields()
  {
    $generator = new VCardGenerator();
    $vcard = $generator->createVcard(
      [
        'first_name' => 'Bob',
        // last_name missing.
        'email' => 'bob@example.com',
      ]
    );
    $this->assertStringContainsString('FN:Bob', $vcard);
    $this->assertStringContainsString('EMAIL:bob@example.com', $vcard);
    $this->assertStringContainsString('BEGIN:VCARD', $vcard);
    $this->assertStringContainsString('END:VCARD', $vcard);
  }

  /**
   * Test vCard generation with no data and check for missing FN/EMAIL.
   *
   * @return void
   */
  public function testCreateVcardWithNoData() {
    $generator = new VCardGenerator();
    $vcard = $generator->createVcard([]);
    $this->assertStringContainsString('BEGIN:VCARD', $vcard);
    $this->assertStringContainsString('END:VCARD', $vcard);
    $this->assertStringNotContainsString('FN:', $vcard);
    $this->assertStringNotContainsString('EMAIL:', $vcard);
  }

  /**
   * Test vCard generation to cover all conditional branches.
   *
   * @return void
   */
  public function testCreateVcardCoversAllBranches() {
    $generator = new VCardGenerator();
    // Only first name.
    $vcard = $generator->createVcard(['first_name' => 'OnlyFirst']);
    $this->assertStringContainsString('FN:OnlyFirst', $vcard);
    // Only last name.
    $vcard = $generator->createVcard(['last_name' => 'OnlyLast']);
    $this->assertStringContainsString('FN: OnlyLast', $vcard);
  }

  /**
   * Test vCard generation with all possible fields populated.
   *
   * @return void
   */
  public function testCreateVcardWithAllFields()
  {
    $generator = new VCardGenerator();
    $vcard = $generator->createVcard(
      [
        'first_name' => 'Thomas A.',
        'last_name' => 'Anderson',
        'email' => 'neo@thematrix.localhost',
        'phone' => '+1-800-NEO-0001',
        'address' => [
          'street' => '303 Matrix Lane',
          'city' => 'Mega City',
          'state' => 'Zion',
          'zip' => '10101',
          'country' => 'Simulated Reality',
        ],
        'organization' => 'Resistance',
        'department' => 'The One',
        'title' => 'The One',
        'url' => 'https://thematrix.localhost/neo',
      ]
    );
    $this->assertStringContainsString('FN:Thomas A. Anderson', $vcard);
    $this->assertStringContainsString('EMAIL:neo@thematrix.localhost', $vcard);
    $this->assertStringContainsString('TEL:+1-800-NEO-0001', $vcard);
    $this->assertStringContainsString(
      'ADR:;;303 Matrix Lane;Mega City;Zion;10101;Simulated Reality',
      $vcard
    );
    $this->assertStringContainsString(
      'URL:https://thematrix.localhost/neo',
      $vcard
    );
    $this->assertStringContainsString('BEGIN:VCARD', $vcard);
    $this->assertStringContainsString('END:VCARD', $vcard);
  }

}
