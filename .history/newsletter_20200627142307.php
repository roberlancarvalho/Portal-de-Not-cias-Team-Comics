<?php
if (isset($_POST['enviar']) and isset($_POST['email'])) {
    if ($_POST['email'] != "") {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = "O email digitado não é um endereço de email válido.";
        } else {
            $link = mysqli_connect('localhost', 'root', '123');
            mysqli_select_db($link, 'newsletter');
            $sql = 'INSERT INTO newsletter SET email = "' . $email . '"';
            $sql1 = 'SELECT email FROM newsletter WHERE email = "' . $email . '"';

            if (mysqli_query($link, $sql1) == true) {
                $result = "Seu email já está registrado.";
            } else {
                if (mysqli_query($link, $sql)) {
                    $result = "Seu email foi registrado com sucesso. Obrigado pelo seu interesse na Team Comics!";
                }
            }
        }
    } else {
        $result = 'Por favor, indique o seu endereço de e-mail.';
    }
}
