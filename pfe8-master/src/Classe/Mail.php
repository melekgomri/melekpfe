<?php
namespace App\Classe;
use Mailjet\Client;
use \Mailjet\Resources;

class Mail{
    public function send($to_email,$to_name,$content, $subject){
        $mj = new \Mailjet\Client('4e4c82a27c0057084a672d22dd01783d','e9dda1a25becb9b6038a76c7f9b1f6bb',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "malekgomri881@hotmail.com",
                  'Name' => "melek"
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
$response->success() && dd($response->getData());
    }
}






?>