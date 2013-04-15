<?php
$CONFIG['users']['onlinePingInterval'] =  30000;
$CONFIG['users']['missedPingsCount'] =  4;

/**
 * Yubikey Configuration
 */
$CONFIG['Users']['Yubikey']['AuxConfig']['yubico_id']  =  4264;
$CONFIG['Users']['Yubikey']['AuxConfig']['yubico_key'] =  'ETbmajX8ozu1h/cqvRvBD28G6A4=';

$CONFIG['Users']['Users']['AuxConfig']['userPropertiesMap'] = array(
    'name' => 'full_name',
    'sex' => 'sex',
    'birthdate' => 'birthdate',
    'facebook' => 'facebook',
    'twitter' => 'twitter',
    'skype' => 'skype',
    'emailAlertBoy' => 'email_alert_boy',
    'emailAlertGirl' => 'email_alert_girl',
    'hostId' => 'host_id',
    'langId' => 'lang_id'
);
