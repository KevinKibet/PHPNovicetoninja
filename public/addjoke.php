<?php
if (isset($_POST['joketext'])) {
try {
include __DIR__ . '/../includes/DatabaseConnection.php';

$sql = 'INSERT INTO `joke` SET
`joketext` = :joketext,
`jokedate` = CURDATE()';

$smtp = $pdo->prepare($sql);
$smtp->bindValue(':joketext', $_POST['joketext']);
$smtp->execute();

header('location: joke.php');

} catch (PDOException $e) {
$title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . ' in '
. $e->getFile() . ':' . $e->getLine();
}
} else {
$title = 'Add a new joke';
ob_start();
include __DIR__ . '/../templates/addjokes.html.php';
$output = ob_get_clean();
}
include __DIR__ . '/../templates/layout.html.php';


?>