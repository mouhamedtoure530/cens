<?php

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupère les données du formulaire
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Vérifie si les données sont valides
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirige l'utilisateur en cas d'erreur
        http_response_code(400);
        echo "Oups! Il y a eu un problème avec votre envoi. Veuillez vérifier vos informations et réessayer.";
        exit;
    }

    // Configure l'adresse email de destination
    $recipient = "contact@cens.org";
    $subject = "Nouveau message de contact du site de la CENS";

    // Construit le contenu de l'email
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Construit l'en-tête de l'email
    $email_headers = "From: $name <$email>";

    // Envoie l'email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Envoi réussi, redirige vers une page de succès
        http_response_code(200);
        echo "Merci! Votre message a été envoyé avec succès.";
    } else {
        // Envoi échoué
        http_response_code(500);
        echo "Oups! Quelque chose s'est mal passé et nous n'avons pas pu envoyer votre message.";
    }

} else {
    // Si la requête n'est pas POST, on renvoie une erreur
    http_response_code(403);
    echo "Il y a eu un problème avec votre envoi, veuillez réessayer.";
}
?>