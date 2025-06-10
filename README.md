# Magmodules_AlternateHreflangGraphQl

This module provides GraphQL support for the `Magmodules_AlternateHreflang` module, allowing you to retrieve `hreflang` alternate URLs for products, categories, and CMS pages via GraphQL.

## Features

- GraphQL endpoint for retrieving alternate hreflang URLs.
- Per-entity resolvers for:
  - Products
  - Categories
  - CMS Pages
- Uses Magento StoreView context for correct URL resolution.

---

## Install via Composer

Make sure the base module `Magmodules_AlternateHreflang` is already installed.

1. Go to Magento® 2 root folder

2. Enter the following commands to install module:

   ```
   composer require magmodules/m2-alternate-hreflang-graph-ql
   ``` 

3. Enter following commands to enable module:

   ```
   php bin/magento module:enable Magmodules_AlternateHreflangGraphQl
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```

4. If Magento® is running in production mode, deploy static content with the following command:

   ```
   php bin/magento setup:static-content:deploy
   ```
   
---

## Usage

### Products

```graphql
{
  products(filter: {sku: {eq: "example-sku"}}) {
    items {
      hreflang {
        code
        url
      }
    }
  }
}
```

### Categories

```graphql
{
  category(id: 3) {
    hreflang {
      code
      url
    }
  }
}
```

### CMS Pages

```graphql
{
  cmsPage(identifier: "home") {
    title
    hreflang {
      code
      url
    }
  }
}
```

---

## Configuration

Ensure that the base module is enabled and that hreflang output is configured in the Magento Admin:

**Stores > Configuration > Magmodules > Alternate Hreflang**

---

## Structure

- `CmsAlternateUrls` – GraphQL resolver for CMS pages
- `CategoryAlternateUrls` – GraphQL resolver for categories
- `ProductAlternateUrls` – GraphQL resolver for products
- `BaseAlternateResolver` – Shared helper logic for formatting response

---

## Testing

Use tools like [GraphiQL](https://github.com/graphql/graphiql) or Magento PWA Studio to test queries.

---

## License

See `COPYING.txt`. All rights reserved © Magmodules.eu.
