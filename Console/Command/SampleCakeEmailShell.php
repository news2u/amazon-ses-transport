<?php
/**
 *  Sample of CakeEmail Transport for Amazon SES
 *
 *  @copyright Copyright 2012 News2u Corporation
 *  @link http://www.news2u.co.jp/
 *  @package cake
 *  @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 */
CakePlugin::loadAll();
App::uses('CakeEmail', 'Network/Email');

/**
 * Sample of CakeEmail Transport for Amazon SES
 *
 * Test for sending email via Amazon SES
 *
 * @package cake
 * @subpackage Console.Shell
 */
class SampleCakeEmailShell extends AppShell {
    public function main() {
        $email = new CakeEmail();
        $email->config(array(
                'transport' => 'AmazonSESTransport.AmazonSES',
                'log' => true,
                'Amazon.SES.Key' => Configure::read('Amazon.SES.Key'),
                'Amazon.SES.Secret' => Configure::read('Amazon.SES.Secret'),
            ));

        $email->sender('no-reply@example.org');
        $email->from('no-reply@example.org', 'Example');
        $email->to('test@example.org');
        $email->bcc('bcc@example.org');
        $email->subject('SES Test from CakePHP');

        $res = $email->send('test message.');
        var_dump($res);
    }
}
