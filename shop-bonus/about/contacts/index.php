<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задайте вопрос");
?>

	<p>
        <b>Адреса электронной почты:</b> BaryshevaAD1@mos.ru, StarenkoOG@mos.ru, PORT-communications@mos.ru
	</p>


	<h2>Задать вопрос</h2>

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.feedback",
		"bootstrap_v4",
		Array(
			"EMAIL_TO" => "BaryshevaAD1@mos.ru, StarenkoOG@mos.ru, PORT-communications@mos.ru",
			"EVENT_MESSAGE_ID" => array(),
			"OK_TEXT" => "Спасибо, ваше сообщение принято.",
			"REQUIRED_FIELDS" => array("NAME","EMAIL"),
			"USE_CAPTCHA" => "N"
		)
	);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>