# Drupal vCard Generator

[![CI](https://github.com/RumenDamyanov/drupal_vcard_generator/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/RumenDamyanov/drupal_vcard_generator/actions/workflows/ci.yml)
[![codecov](https://codecov.io/gh/RumenDamyanov/drupal_vcard_generator/branch/master/graph/badge.svg)](https://codecov.io/gh/RumenDamyanov/drupal_vcard_generator)

## Features

- Provides a service for generating vCards in Drupal.
- 100% PHPUnit unit test coverage.
- Composer-managed dependencies.

## Installation

### Drupal.org Installation (Recommended)

You can install the module from Drupal.org either manually or using Composer:

#### Option 1: Composer (Recommended)

```bash
composer require drupal/vcard_generator
```

Enable the module in Drupal admin or via Drush:

```bash
drush en vcard_generator
```

#### Option 2: Manual Installation

1. Download from Drupal.org:
   - [https://www.drupal.org/project/vcard_generator](https://www.drupal.org/project/vcard_generator)
   - Git: `git clone https://git.drupalcode.org/project/vcard_generator.git`
2. Copy the `vcard_generator` folder into your Drupal site's `modules/custom/` directory.
3. Enable the module:
   ```bash
   drush en vcard_generator
   ```

### Composer (Packagist)

```bash
composer require rumenx/drupal_vcard_generator
```

Enable the module in Drupal admin or via Drush:

```bash
drush en drupal_vcard_generator
```

### Manual Installation (GitHub/Packagist)

1. Download or clone this repository:
   - Download the ZIP from GitHub and extract it, or run:

     ```bash
     git clone https://github.com/RumenDamyanov/drupal_vcard_generator.git
     ```

2. Copy the `drupal_vcard_generator` folder into your Drupal site's `modules/custom/` directory.

3. Enable the module in Drupal admin or via Drush:

     ```bash
     drush en drupal_vcard_generator
     ```

### Usage Example

```php
/** @var \Drupal\drupal_vcard_generator\VCardGenerator $generator */
$generator = \Drupal::service('drupal_vcard_generator.generator');
$vcard = $generator->createVCard([
  'first_name' => 'Jon',
  'last_name' => 'Snow',
  'email' => 'jon.snow@winterfell.localhost',
]);
echo $vcard;
```

## Advanced Usage Example

```php
/** @var \Drupal\drupal_vcard_generator\VCardGenerator $generator */
$generator = \Drupal::service('drupal_vcard_generator.generator');
$vcard = $generator->createVCard([
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
EMAIL:neo@thematrix.localhost
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

## Note on Namespaces and Composer Package

- **Drupal.org:**
  - Composer package: `drupal/vcard_generator`
  - Namespace: `Drupal\vcard_generator`
  - Service name: `vcard_generator.generator`
  - Info/Services YAML: `vcard_generator.info.yml`, `vcard_generator.services.yml`
- **Packagist/GitHub:**
  - Composer package: `rumenx/drupal_vcard_generator`
  - Namespace: `Drupal\drupal_vcard_generator`
  - Service name: `drupal_vcard_generator.generator`
  - Info/Services YAML: `drupal_vcard_generator.info.yml`, `drupal_vcard_generator.services.yml`

If you need to switch between the two, update the namespace in your PHP files and the `composer.json` autoload section accordingly. The codebase and service names must match the installation method.

## License

[MIT License](LICENSE.md)
