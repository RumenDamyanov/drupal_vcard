<?php

namespace Drupal\vcard_generator;

use Rumenx\PhpVcard\VCard;

/**
 * Service for generating vCards.
 *
 * @category Service
 * @package Drupalvcard_Generator
 */
class VCardGenerator {

  /**
   * Create a vCard string from an array of data.
   *
   * @param array $data
   *   An associative array of data to be included in the vCard.
   *   Supported keys:
   *   - first_name: string, the first name.
   *   - last_name: string, the last name.
   *   - email: string, the email address.
   *   - phone: string, the phone number.
   *   - address: array, with keys 'street', 'city', 'state', 'zip', 'country'.
   *   - organization: string, the organization name.
   *   - department: string, the department name.
   *   - title: string, the job title.
   *   - url: string, a website URL.
   *
   * @return string
   *   The vCard string.
   */
  public function createVcard(array $data): string {
    $vcard = new VCard();
    if (!empty($data['first_name']) && !empty($data['last_name'])) {
      $vcard->addName($data['first_name'], $data['last_name']);
    }
    elseif (!empty($data['first_name'])) {
      $vcard->addName($data['first_name'], '');
    }
    elseif (!empty($data['last_name'])) {
      $vcard->addName('', $data['last_name']);
    }
    if (!empty($data['email'])) {
      $vcard->addEmail($data['email']);
    }
    if (!empty($data['phone'])) {
      $vcard->addPhone($data['phone']);
    }
    if (!empty($data['address'])) {
      $address = $data['address'];
      $vcard->addAddress(
            $address['street'] ?? '',
            $address['city'] ?? '',
            $address['state'] ?? '',
            $address['zip'] ?? '',
            $address['country'] ?? ''
                );
    }
    if (!empty($data['organization'])) {
      $vcard->addOrganization(
            $data['organization'],
            $data['department'] ?? NULL
                );
    }
    if (!empty($data['title'])) {
      $vcard->addTitle($data['title']);
    }
    if (!empty($data['url'])) {
      $vcard->addUrl($data['url']);
    }
    // Add more fields as needed.
    return $vcard->toString();
  }

}
