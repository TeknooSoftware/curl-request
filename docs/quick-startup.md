#Uni Alteri - Curl Request library - Quick startup

##Presentation
This library has been designed around three components :

- The request object, implementing `UniAlteri\Curl\RequestInterface` to perform requests via cUrl.
- The generator, to create new instances of requests.
- The option manger, implementing `UniAlteri\Curl\OptionsInterface` to manage, check and apply selected options on cUrl sessions.
 There are only one instance by generator.

##Create and execute a request

You can get a new request object via the `RequestGenerator`. By default, the `RequestGenerator` is configured
to generate a `UniAlteri\Curl\Request` object. The generator returns new instance of request object by cloning 
 the original request : this library use the method `curl_copy_handle` to perform the session cloning. 
 
    $generator = new UniAlteri\Curl\RequestGenerator();
 
The original request is built only at first call of `getRequest()`. 

    $request = $generator->getRequest();
    
You can configure the request by calling its method :

    //Fetch the URL http://teknoo.it with a GET Method.
    $request->setUrl('http://teknoo.it')
        ->setMethod('GET');
    
    //Configure another cUrl options
    $request->setOption(CURLOPT_AUTOREFERER, true);
    
By default, the result of the request is returned by calling the method `execute()

    try {
        echo $request->execute();
    } catch (UniAlteri\Curl\ErrorException $e) {
        echo $e->getMessage();
    }
    
You can also configure the request to display directly the result of the request
  
    $request->setReturnValue(falsee);
    try {
        $request->execute();
    } catch (UniAlteri\Curl\ErrorException $e) {
        echo $e->getMessage();
    }

##Custom generator configuration

You can also configure the request object to use as original. It must be passed as argument to the generator

    //Create the original request
    $options = new UniAlteri\Curl\Options();
    $originalRequest = new UniAlteri\Curl\Request($options);
    
    //Configure it
    $originalRequest->setUrl('http://teknoo.it');
    $originalRequest->setMethod('POST');
    
    //Create the generator
    $generator = new UniAlteri\Curl\RequestGenerator($options, $originalRequest);
    
    //Create a new request
    //This request is already configured to fetch the url "http://teknoo.it" in POST method.
    $newRequest = $generator->getReques();
    
    try {
        echo $request->execute();
    } catch (UniAlteri\Curl\ErrorException $e) {
        echo $e->getMessage();
    }

By this way, you can also configure the generator to use your custom request class implementing the interface `UniAlteri\Curl\RequestInterface`.
    
##Use with symfony

To use this library as Symfony service, add these line in your file `service.yml` in your Bundle
 
    service.request_generator:
            class:     UniAlteri\Curl\RequestGenerator

To create a request object

    $request = $this->get('service.request_generator')->getRequest();
