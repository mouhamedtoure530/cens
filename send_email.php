<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = strip_tags(trim($_POST["nom"]));
    $nom = str_replace(array("\r","\n"),array(" "," "),$nom);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $sujet = strip_tags(trim($_POST["sujet"]));
    $message = trim($_POST["message"]);

    // Vérifier les données
    if (empty($nom) || empty($sujet) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Oups! Il y a un problème avec votre envoi. Veuillez remplir tous les champs.";
        exit;
    }

    // L'adresse email de destination
    $destinataire = "mouhamed.toure5@unchk.edu.sn"; // <-- REMPLACEZ PAR L'EMAIL DE LA CENS

    // Le sujet de l'email
    $email_sujet = "Nouveau message de CENS depuis le site : $sujet";

    // Le contenu de l'email
    $email_contenu = "Nom: $nom\n";
    $email_contenu .= "Email: $email\n\n";
    $email_contenu .= "Message:\n$message\n";

    // Les en-têtes de l'email
    $email_headers = "From: $nom <$email>\r\n";
    $email_headers .= "Reply-To: $email\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envoyer l'email
    if (mail($destinataire, $email_sujet, $email_contenu, $email_headers)) {
        http_response_code(200);
        echo "Merci! Votre message a été envoyé avec succès.";
    } else {
        http_response_code(500);
        echo "Oups! Quelque chose s'est mal passé et nous n'avons pas pu envoyer votre message.";
    }

} else {
    // Si la requête n'est pas une requête POST
    http_response_code(403);
    echo "Il y a eu un problème avec l'envoi de votre formulaire. Veuillez réessayer.";
}
?>