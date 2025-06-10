<?php

namespace Drupal\drupal_vcard;

use Rumenx\PhpVcard\VCard;

/**
 * Service for generating vCards.
 */
class VCardGenerator {

  /**
   * Create a vCard string from an array of data.
   *
   * @param array $data
   *   Associative array with vCard fields (first_name, last_name, email, etc).
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
      $vcard->addOrganization($data['organization'], $data['department'] ?? NULL);
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
