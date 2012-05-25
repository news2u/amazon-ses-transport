amazon-ses-transport
====================

Amazon SES Transport Class for CakePHP

This is a plugin to send email with CakeEmail using AmazonSES service.

## Requirements

* CakePHP version 2.0 or later.
* Amazon SES account
* [AWS SDK for PHP](https://github.com/amazonwebservices/aws-sdk-for-php)

## Installation

* Install AWS SDK for PHP to vendor directory
* Install AmazonSESTransport to plugin Directory

    cd app/Plugin
    git clone git://github.com/news2u/amazon-ses-transport.git AmazonSESTransport

## Sample Code

    $email = new CakeEmail();
    $email->config(array(
        'transport' => 'AmazonSESTransport.AmazonSES',
        'log' => true,
        'Amazon.SES.Key' => 'Your AWS Key'
        'Amazon.SES.Secret' => 'Your AWS Secret Key'
    ));
    
    $email->sender('no-reply@example.org');
    $email->from('no-reply@example.org', 'Example');
    $email->to('test@example.org');
    $email->bcc('bcc@example.org');
    $email->subject('SES Test from CakePHP');
    
    $res = $email->send('test message.');

## Author

[News2u Corporation](http://www.news2u.com)

