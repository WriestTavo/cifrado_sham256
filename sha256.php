<?php
/**
* 
* @author WriestTavo
* Decrpcion: método simple para cifrar o descifrar una cadena de texto 
*
*/

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '$WriestTavo@2018'; // la contraseña asiganada 
    $secret_iv = '101712'; //   iv
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - el método de cifrado AES-256-CBC espera 16 bytes; de lo contrario, recibirá una advertencia
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

$mensaje_txt = "Ya termine mi tarea, punto extra."; // Aqui se pude cambiar el mensaje y colocar el texto que deceas encriptar.
echo "Mensaje = " .$mensaje_txt. "<br>";

$encriptar_txt = encrypt_decrypt('encrypt', $mensaje_txt);
echo "Mensaje encriptado = " .$encriptar_txt. "<br>";

$desencriptar_txt = encrypt_decrypt('decrypt', $encriptar_txt);
echo "Mensaje desencriptado =" .$desencriptar_txt. "<br>";

/* Validacion, si el mensaje_txt es identico a desencriptar_txt mandara el sigueinte mensaje " Se Realizo correctamente " 
en dado caso contrario " UPS... ERROR " */

if ( $mensaje_txt === $desencriptar_txt ) echo "Se Realizo correctamente";
else echo "UPS... ERROR";
echo "<br>";

?>