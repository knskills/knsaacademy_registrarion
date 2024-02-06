# Refrence

1. <https://videojs.com/getting-started> - for videojs

### Remove controll from iframe -

[Market path]('https://www.marketpath.com/blog/remove-youtube-info-from-embedded-videos')

```bash
 <iframe width="560" height="315" src="https://www.youtube.com/embed/6Xr8UZiA7Zg?si=FgHjIjw61Q2FZKdV?rel=0&amp;controls=0" frameborder="2" allow="accelerometer; autoplay; modestbranding; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
```

Add src link in -?rel=0&amp;controls=0

## Hindi fonts -

[Google Hindi Font](https://fonts.google.com/?query=deva)

## Conversion api package

[Conversion api](https://github.com/esign/laravel-conversions-api)

## WHasapp and Sms api

1. [twilio](https://www.twilio.com/whatsapp)
2. [msgclub.net](https://www.msgclub.net/)
3. [msgclub home](https://www.msgclub.net/plugins/msgclub-chrome-plugin.aspx)

### Error codes

1. [twilio](https://www.twilio.com/docs/api/errors)
2. [msgclub.net](https://www.msgclub.net/bulk-sms-gateway-api/error-codes.html)

## Msgclub.net whatsapp api setup code -

[Msgclub.net (Send WhatsApp Chat)](https://panel.msgclub.net/developerToolAPI.html#)

```php
 public function sendWhatsAppMessage($phone, $message)
    {
        $authKey = getenv("MSGCLUB_AUTH_KEY");
        $whatsappNumber = getenv("MSGCLUB_AWHATSAPP_NO");
        $toNumber = $phone; // Replace with the recipient's WhatsApp number
        $bodyText = $message; // Replace with the message body text

        $url = 'http://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate?AUTH_KEY=' . $authKey;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cookie' => 'JSESSIONID=23BD7D8B4F08B438F9A42E5334C2DDEB.node3',
        ])->post($url, [
            'senderId' => $whatsappNumber,
            'component' => [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $toNumber,
                'type' => 'text',
                'text' => [
                    'preview_url' => true,
                    'body' => $bodyText,
                ],
            ],
        ]);

        return $response->body();
    }
```

### convert image to base64
[convert image to base64](https://www.itsolutionstuff.com/post/how-to-convert-image-to-base64-in-laravelexample.html)

### Composer autoload

```bash
composer dump-autoload
```
