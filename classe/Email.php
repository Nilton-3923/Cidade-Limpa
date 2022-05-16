<?php
    require_once("../src/PHPMailer.php");
    require_once("../src/SMTP.php");
    require_once("../src/Exception.php");

    require_once("Denuncia.php");

    $email = new Denuncia();

    $corpoEmail = $email -> corpoEmail();

    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception; 


    class Email{

    public function mandarEmail($tituloEmail, $corpoEmail){

    $mail = new PHPMailer(True);
    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chiruabagualado@gmail.com';
        $mail->Passworld = '123';
        $mail->Port = 587;

        $mail->SetFrom('chiruabagualado@gmail.com');
        $mail->AddAddress('niltongabrielramos@gmail.com');


        $mail->IsHTML(true);
        $mail->Subject= 'Denuncia de irregularidades';
        $mail->Body = $corpoEmail;
        $mail->AltBody = $corpoEmail;

        if($mail->Send()){
            return "Denuncia feita com sucesso";
        }
    }catch(Exception $e){
        return "Erro ao enviar a Denuncia: {$mail->ErrorInfo}";
    }
        
        }
    }



?>