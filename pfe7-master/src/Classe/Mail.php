<?php
namespace App\Classe;
use Mailjet\Client;
use \Mailjet\Resources;

class Mail{
    public function send($to_email,$to_name,$content, $subject){
        $mj = new \Mailjet\Client('4e4c82a27c0057084a672d22dd01783d','f00f798a581a1405179e8d8ecaff629f',true,['version' => 'v3.1']);
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
                'Subject' => $subject,
                'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
                'CustomID' => "AppGettingStartedTest",
                'TextPart' => "My first Mailjet email",
                'Variables' => [
                  'content'=>$content,
                      ]
                  ]
              ]
          ];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success() && dd($response->getData());
    }
}






?>