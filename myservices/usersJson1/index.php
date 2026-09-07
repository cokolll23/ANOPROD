<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Users Json");
?>
<?php
use Lab\Bd\BirthdayAgent;
pretty_print(BirthdayAgent::getBDUsers());
?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>