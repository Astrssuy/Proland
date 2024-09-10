<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Verifica que todos los campos estén completos
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor completa todos los campos y proporciona un correo electrónico válido.";
        exit;
    }

    // Establece el destinatario del correo
    $recipient = "robinxonx37@gmail.com"; // Cambia este correo por el tuyo

    // Crea el contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Correo: $email\n";
    $email_content .= "Asunto: $subject\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Encabezados del correo
    $email_headers = "From: $name <$email>";

    // Intenta enviar el correo
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "¡Gracias! Tu mensaje ha sido enviado.";
    } else {
        http_response_code(500);
        echo "Ocurrió un error al enviar el mensaje. Inténtalo de nuevo más tarde.";
    }

} else {
    http_response_code(403);
    echo "Hubo un problema con el envío del formulario, intenta nuevamente.";
}
?>
