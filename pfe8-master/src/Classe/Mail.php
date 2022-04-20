<?php
namespace App\Classe;
use Mailjet\Client;
use \Mailjet\Resources;

class Mail{
    public function send($to_email,$to_name,$content, $subject){
        $mj = new \Mailjet\Client('4e4c82a27c0057084a672d22dd01783d','152d794f1826847378564bdfe961a42e',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "malekgomri881@hotmail.com",
                  'Name' => "west world shirts"
                ],
                'To' => [
                  [
                    'Email' => $to_email,
                    'Name' => $to_name
                  ]
                ],
                'TemplateID' =>3690220,
        'TemplateLanguage' => true,
        'Subject' => $subject,
        'Variables' => [
          'content' => $content,
       ]
     ]
       ]
          ];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() ;
    }
}






?>