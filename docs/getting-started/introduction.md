# Laravel JSON:API Format Paginate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/oscabrera/laravel-json-api-format-paginate.svg?style=flat-square)](https://packagist.org/packages/oscabrera/laravel-json-api-format-paginate)

[![Total Downloads](https://img.shields.io/packagist/dt/oscabrera/laravel-json-api-format-paginate.svg?style=flat-square)](https://packagist.org/packages/oscabrera/laravel-json-api-format-paginate)

[![built with Codeium](https://codeium.com/badges/main)](https://codeium.com)

![laravel-json-api-format-paginate](https://socialify.git.ci/Oscabrera/laravel-json-api-format-paginate/image?language=1&name=1&owner=1&pattern=Floating%20Cogs&theme=Auto)

This package provides three classes for responding with Resource and Collection in JSON:API format. Simplifies the
transformation of Eloquent models and pagination results into JSON:API-compliant responses. Additionally, it integrates
filtering and sorting capabilities using Spatie packages.

## Advantages of JSON  and Pagination JSON:API

is a specification for building APIs in JSON format that standardizes responses, facilitating interoperability between
different systems. Some of the advantages include:

- Standardization: Consistent and predictable responses.
- Overload Reduction: Avoid duplication of data in responses.
- Ease of Use: Simplifies the consumption of the API from the client.

## Pagination in JSON

allows you to handle large data sets efficiently, providing links to previous and next pages, as well as metadata about
pagination.