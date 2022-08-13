# trenalyze(PHP) V1.2.0

[Author](https://treasureuvietobore.com/) |
[Docs](https://github.com/Trenalyze/trenalyze-php#readme)


## Library Prerequisites

1. PHP >= 7X
1. WhatsApp account.
1. Active Token - Get a Token [here](https://trenalyze.com).


## Installation


Using composer:
```shell
$ composer require trenalyze/trenalyze
```
**Note:** Add this line of code in your composer.json file
```json
"minimum-stability": "dev",
```

In PHP:

**Note:** You'll need to require the Trenalyze PHP Library after installation

```php
// Load the full build.
require_once __DIR__ . '/vendor/autoload.php';

use Trenalyze\Trenalyze;
```
## API

### 1. new Trenalyze(token, sender, true)

| Param | Type | Description |
| --- | --- | --- |
| token | `string` | Use your Trenalyze Token from your [Dashboard](https://trenalyze.com). |
| sender | `interger` | Enter the WhatApp Number that has already be scanned on the Trenalyze [Dashboard](https://trenalyze.com). |
| debug | `boolean` | (OPTIONAL). Default is false. But you can set to be true and the debug message is passed onto the console. |

```php
// Set The Config
$wa = new Trenalyze(YOUR_TRENALYZE_TOKEN_HERE, YOUR_WHATASPP_NUMBER_HERE, true);
```

**Note:** Phone number should be in following format `12345678912`, without `+` or any other symbols

### 2. Initialize needed params in an array 

| Param | Type | Description |
| --- | --- | --- |
| receiver | `interger` | Phone number should be in following format `12345678912`, without `+` or any other symbols. |
| message | `interger` | Enter the desired text message to send. |
| mediaurl | `string` | (OPTIONAL). **BUT MUST BE DECLARED** This should be a valid media/file link. [Learn More](https://trenalyze.com) |
| buttons | `array` | (OPTIONAL). **BUT MUST BE DECLARED** You can attach quick replies buttons to your message. [Learn More](https://trenalyze.com) |
```php
// Set the Required Parameters for sending message 
$receiver: '123456789',
$message: 'Hello World',
$mediaurl: 'https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png',
$buttons: [
    ['index' => 1, 'urlButton' => ['displayText' => 'Visit my website!', 'url' => 'https://trenalyze.com']],
    ['index' => 2, 'callButton' => ['displayText' => 'Call me!', 'phoneNumber' => '+1 (234) 5678-9012']],
    ['index' => 3, 'quickReplyButton' => ['displayText' => 'This is a reply, just like normal buttons!', 'id' => 'id-like-buttons-message']],
];

```
**NOTE:** When not using **mediaurl** and **buttons** set to **NULL**
```js
mediaurl: '',
buttons: ''
```

### 3. Initialize SendMessage

| Param | Type | Description |
| --- | --- | --- |
| receiver | `interger` | Phone number should be in following format `12345678912`, without `+` or any other symbols. |
| message | `interger` | Enter the desired text message to send. |
| mediaurl | `string` | (OPTIONAL). **BUT MUST BE DECLARED** This should be a valid media/file link. [Learn More](https://trenalyze.com) |
| buttons | `array` | (OPTIONAL). **BUT MUST BE DECLARED** You can attach quick replies buttons to your message. [Learn More](https://trenalyze.com) |

```php
// Initialize the send whatsapp message functions
$res = json_decode($wa->sendMessage($receiver, $message, $buttons, $mediaurl));
```

### 4. Ensure to get the status of step 3 Action

```php
if ($res->statusCode != 200) {
    echo $res->message;
} else {
    echo 'WhatsApp Message sent successfully';
}
```