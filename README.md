# Handle R4nkt webhooks in a Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/r4nkt/laravel-r4nkt-webhooks.svg?style=flat-square)](https://packagist.org/packages/r4nkt/laravel-r4nkt-webhooks)
[![StyleCI](https://styleci.io/repos/109316815/shield?branch=master)](https://styleci.io/repos/109316815)
[![Quality Score](https://img.shields.io/scrutinizer/g/r4nkt/laravel-r4nkt-webhooks.svg?style=flat-square)](https://scrutinizer-ci.com/g/r4nkt/laravel-r4nkt-webhooks)
[![Total Downloads](https://img.shields.io/packagist/dt/r4nkt/laravel-r4nkt-webhooks.svg?style=flat-square)](https://packagist.org/packages/r4nkt/laravel-r4nkt-webhooks)

[R4nkt](https://r4nkt.com) can notify your application of events using webhooks. This package can help you handle those webhooks. Out of the box it will verify the R4nkt signature of all incoming requests. You can easily define jobs or events that should be dispatched when specific events hit your app.

This package will not handle what should be done after the webhook request has been validated and the right job or event is called.

Before using this package we highly recommend reading [the documentation on webhooks over at R4nkt](https://r4nkt.com/docs/1.0/webhooks/laravel-package).

## Documentation

All package documentation can be found on the [R4nkt website](https://r4nkt.com/docs/1.0/webhooks/overview).

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email support@r4nkt.com instead of using the issue tracker.

## Credits

- [Travis Elkins](https://github.com/telkins)
- [Freek Van der Herten](https://github.com/freekmurze)
- [Mattias Geniar](https://github.com/mattiasgeniar)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
