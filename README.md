Anonym-HttpClient
================

Bu a��klamada http client de sahip olunan s�n�flar�n nas�l kullan�ld���n� a��kl�yorum.

Response
----------------


```php

$response = new Response('��erik', 200); // durum kodu
// $response = Response::make('Hello World', 200);
// $response->setCharset('UTF-8');
$response->send();

```


**getCookies:**

```php
$cookies = $response->getCookies();
```


Ba�l�k Eklemek
-------------

```php

$respone->header('baslik:deger');

```

JsonResponse
-----------

```php

$json = Response::jsonResponse('Hello world', 200);

```