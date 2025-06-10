# Drupal vCard

[![CI](https://github.com/RumenDamyanov/drupal_vcard/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/RumenDamyanov/drupal_vcard/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/RumenDamyanov/drupal_vcard/branch/master/graph/badge.svg)](https://codecov.io/gh/RumenDamyanov/drupal_vcard)

## Features

- Provides a service for generating vCards in Drupal.
- 100% PHPUnit unit test coverage.
- Composer-managed dependencies.

## Installation

### Composer (Recommended)

```bash
composer require rumenx/drupal_vcard
```

Enable the module in Drupal admin or via Drush:

```bash
drush en drupal_vcard
```

### Manual Installation

1. Download or clone this repository:
   - Download the ZIP from GitHub and extract it, or run:

     ```bash
     git clone https://github.com/RumenDamyanov/drupal_vcard.git
     ```

2. Copy the `drupal_vcard` folder into your Drupal site's `modules/custom/` directory.

3. Enable the module in Drupal admin or via Drush:

     ```bash
     drush en drupal_vcard
     ```

## Usage Example

```php
/** @var \Drupal\drupal_vcard\VCardGenerator $generator */
$generator = \Drupal::service('drupal_vcard.generator');
$vcard = $generator->createVCard([
  'first_name' => 'Jon',
  'last_name' => 'Snow',
  'email' => 'jon.snow@winterfell.localhost',
]);
echo $vcard;
```

## Advanced Usage Example

```php
/** @var \Drupal\drupal_vcard\VCardGenerator $generator */
$generator = \Drupal::service('drupal_vcard.generator');
$vcard = $generator->createVCard([
  'first_name' => 'Thomas A.',
  'last_name' => 'Anderson',
  'email' => 'neo@thematrix.com',
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
]);
file_put_contents('neo.vcf', $vcard);
```

## Supported Fields

- `first_name`, `last_name`: Person's name
- `email`: Email address
- `phone`: Phone number
- `address`: Array with `street`, `city`, `state`, `zip`, `country`
- `organization`: Organization name
- `department`: Department/unit (optional)
- `title`: Job title
- `url`: Website

## Example Output

```text
BEGIN:VCARD
VERSION:3.0
N:Anderson;Thomas A.
FN:Thomas A. Anderson
EMAIL:neo@thematrix.com
TEL:+1-800-NEO-0001
ADR:;;303 Matrix Lane;Mega City;Zion;10101;Simulated Reality
ORG:Resistance;The One
TITLE:The One
URL:https://thematrix.localhost/neo
END:VCARD
```

## Testing

Run lint and unit tests with:

```
composer lint
composer test
```

## License

MIT. See [LICENSE.md](LICENSE.md).
