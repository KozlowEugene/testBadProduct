<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отчёт");
?><?$APPLICATION->IncludeComponent("custom:bad_product", "", array(
	"QUANTITY" => 2,
	"COUNT_DAY" => 7,
),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>