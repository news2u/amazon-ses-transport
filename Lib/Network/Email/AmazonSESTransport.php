<?php
/** 
 * Send mail using Amazon SES service
 *
 * This depends on AWS SDK for PHP (https://github.com/amazonwebservices/aws-sdk-for-php.git).
 *
 * @copyright Copyright 2012 News2u Corporation
 * @link http://www.news2u.co.jp/
 * @since CakePHP v2.0.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AbstractTransport', 'Network/Email');

/**
 * Send mail using Amazon SES service
 * 
 * @package Cake
 * @subpackage Lib.Network.Email
 */
class AmazonSESTransport extends AbstractTransport {

    /**
     * Send mail
     *
     * @param CakeEmail $email CakeEmail
     * @return array
     * @throws SocketException When mail cannot be sent.
     */
	public function send(CakeEmail $email) {
        App::import('Vendor', 'Amazon', array('file' => 'AWSSDKforPHP/sdk.class.php'));
        $init_options['key'] = $this->_config['Amazon.SES.Key'];
        $init_options['secret'] = $this->_config['Amazon.SES.Secret'];
        $ses = new AmazonSES($init_options);

		$eol = PHP_EOL;
		if (isset($this->_config['eol'])) {
			$eol = $this->_config['eol'];
		}

        $option = isset($this->_config['additionalParameters']) ? $this->_config['additionalParameters'] : array();

		$headers = $email->getHeaders(array('from', 'sender', 'replyTo', 'readReceipt', 'returnPath', 'to', 'cc', 'subject'));
		$headers = $this->_headersToString($headers);
		$message = implode($eol, (array)$email->message());
        $raw_message = $headers . $eol . $eol . $message;
        $res = $ses->send_raw_email(array('Data'=>base64_encode($raw_message)), $option);
        if ($res->status != 200) {
            CakeLog::write('error', var_export($res,1));
            throw new SocketException(__d('cake_dev', 'Could not send email.'));
        }
		return array('headers' => $headers, 'message' => $message);
	}
}
