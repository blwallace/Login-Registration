<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

  $config['mailtype'] = 'html';
  $config['charset'] = 'utf-8';

  $config['protocol'] = 'smtp';
  $config['smtp_host'] = 'ssl://smtp.mailgun.org';
  $config['smtp_port'] = 465;
  $config['smtp_user'] = 'blwallace@gmail.com';
  $config['smtp_pass'] = 'thecure1';
  $config['smtp_timeout'] = '4';
  $config['crlf'] = '\n';
  $config['newline'] = '\r\n';
//end of email.php