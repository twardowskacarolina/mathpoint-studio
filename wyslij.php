<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: https://mathpointstudio.pl');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false]);
    exit;
}

// honeypot
if (!empty($_POST['website'])) {
    echo json_encode(['ok' => true]);
    exit;
}

$name    = trim($_POST['name']    ?? '');
$contact = trim($_POST['contact'] ?? '');
$level   = trim($_POST['level']   ?? '');
$mode    = trim($_POST['mode']    ?? '');
$msg     = trim($_POST['msg']     ?? '');

// walidacja
if (!$name || !$contact || !$level) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Brak wymaganych pól.']);
    exit;
}

$isEmail = filter_var($contact, FILTER_VALIDATE_EMAIL);
$digits  = preg_replace('/\D/', '', $contact);
if (!$isEmail && strlen($digits) < 9) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Niepoprawny kontakt.']);
    exit;
}

$to      = 'kontakt@mathpoint-studio.com';
$subject = '=?UTF-8?B?' . base64_encode('Nowe zgłoszenie - MathPoint Studio') . '?=';

$body  = "Nowe zgłoszenie ze strony mathpointstudio.pl\n";
$body .= "==========================================\n\n";
$body .= "Imię:        $name\n";
$body .= "Kontakt:     $contact\n";
$body .= "Etap nauki:  $level\n";
$body .= "Forma:       $mode\n";
if ($msg) {
    $body .= "\nWiadomość:\n$msg\n";
}

$headers  = "From: formularz@mathpointstudio.pl\r\n";
$headers .= "Reply-To: $contact\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP\r\n";

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Błąd wysyłki. Spróbuj napisać bezpośrednio na kontakt@mathpoint-studio.com']);
}
