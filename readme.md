## Usage
To use the `paramFilterMiddleware`, you need to add it to your middleware stack. Typically, this is done in the `App\Http\Kernel.php` class.

Open the `App\Http\Kernel.php` class.

Add the ParamFilter\ParamFilterMiddleware to the $middleware array:
##
 `protected $middleware = [
// Other middleware...,
 \ParamFilter\ParamFilterMiddleware::class
 ];`
##
Optionally, you can extend the ParamFilter\ParamFilterMiddleware class and override the `customCheck()` method to define your own custom logic for request processing.
##
`<?php 
use ParamFilter\ParamFilterMiddleware;
class CustomParamFilterMiddleware extends ParamFilterMiddleware
{
    protected function customCheck(Request $request){
        // Custom logic for request processing
        // Return true to allow the request to proceed, or false to block it.
    }
}
`
##
If you have created a custom middleware class, update the $middleware array in App\Http\Kernel to use your custom middleware instead:
`protected $middleware = [
    // Other middleware...
    \App\Http\Middleware\CustomParamFilterMiddleware::class,
];
`
##
That's it! The `paramFilterMiddleware` package is now ready to handle query parameters in your Laravel application.

## Customization
Except URLs
By default, the middleware removes query parameters from all URLs. However, you can specify exempt URLs where the query parameters should not be removed. To do this, add the exempt URLs to the $exceptUrls array in your custom middleware class or the ParamFilter\ParamFilterMiddleware class:
##
`
private $exceptUrls = [
    // Add URLs that you don't want to remove the query parameters
    '/exempt-url-1',
    '/exempt-url-2',
];
`
##
Redirecting
The middleware automatically redirects to a cleaner URL without query parameters when they are removed. If you want to customize the redirect behavior, you can modify the removeQueryParamsAndRedirect() method in your custom middleware class or the ParamFilter\ParamFilterMiddleware class.

Contributing
Contributions are welcome! If you encounter any issues or have suggestions for improvements, please open an issue or submit a pull request on the GitHub repository.

## License
This package is open-source software licensed under the MIT license.