<?
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sale');

class BadProduct
{
	public static function sendToMail() {
		$domain = $_SERVER['HTTP_HOST'];
		$text = '';
		$arItems = self::getItems(2, 7);
		foreach ($arItems as $arItem) {
			$arSelect = ['ID', 'IBLOCK_ID', 'PROPERTY_ARTNUMBER'];
			$arFilter = ['ID' => $arItem['PRODUCT_ID']];
			$rsFields = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
			if ($arFields = $rsFields->Fetch()) {
				$article = $arFields['PROPERTY_ARTNUMBER_VALUE'];
			} else {
				$article = '-';
			}
			$text .= 'Название товара: ' . $arItem['NAME'] . PHP_EOL;
			$text .= 'Артикул: ' . $article . PHP_EOL;
			$text .= 'Цена: ' . $arItem['PRICE'] . PHP_EOL;
			$text .= 'Ссылка на детальную страницу в магазине: ' . $domain . $arItem['DETAIL_PAGE_URL'] . PHP_EOL;
			$text .= 'Количество продаж за последнюю неделю: ' . (int)$arItem['QUANTITY'] . PHP_EOL;
			$text .= PHP_EOL;
		}

		$email = self::getUsersGroupByCode('executives');

		if (count($email) > 0) {
			Bitrix\Main\Mail\Event::send([
				'EVENT_NAME' => 'BAD_PRODUCT',
				'LID' => 's1',
				'C_FIELDS' => [
					'EMAIL_TO' => implode(', ', $email),
					'TEXT' => $text,
				],
			]);
		}

		return 'BadProduct::sendToMail();';
	}

	private static function getUsersGroupByCode($code) {
		$arUsers = Bitrix\Main\UserGroupTable::getList(
			[
				'group' => ['USER_ID'],
				'select' => [
					'USER_ID',
					'USER_EMAIL' => 'USER.EMAIL',
				],
				'filter' => [
					'GROUP.STRING_ID' => $code,
				],
			]
		)->fetchAll();

		$arUserEmail = [];
		foreach ($arUsers as $user) {
			$arUserEmail[] = $user['USER_EMAIL'];
		}
		return $arUserEmail;
	}

	public static function getItems($minQuantityProduct, $countDay) {
		$arItems = [];
		$arAllItems = self::getAllItems($countDay);
		foreach ($arAllItems as $k => $arItem) {
			if ($arItem['QUANTITY'] < $minQuantityProduct) {
				$arItems[] = $arItem;
			}
		}
		return $arItems;
	}


	private static function getAllItems($countDay) {
		global $DB;
		$arItems = [];
		$time = AddToTimeStamp(['DD' => -$countDay], mktime());

		$ordersRes = Bitrix\Sale\Internals\OrderTable::getList([
			'select' => [
				'ID'
			],
			'filter' => [
				'>=DATE_INSERT' => date($DB->DateFormatToPHP(CSite::GetDateFormat('SHORT')), $time),
			],
			'order' => ['ID' => 'ASC'],
		]);
		while ($order = $ordersRes->fetch()) {
			$arProduct = self::getProductOrder($order['ID']);
			foreach ($arProduct as $product) {
				if ($arItems[$product['PRODUCT_ID']]) {
					$arItems[$product['PRODUCT_ID']]['QUANTITY'] += $product['QUANTITY'];
				} else {
					$arItems[$product['PRODUCT_ID']] = $product;
				}
			}
		}

		return $arItems;
	}

	private static function getProductOrder($idOrder) {
		$arBasketItems = [];

		$basketRes = Bitrix\Sale\Internals\BasketTable::getList([
			'filter' => [
				'ORDER_ID' => $idOrder,
			],
			'select' => [
				'PRODUCT_ID', 'NAME', 'DETAIL_PAGE_URL', 'QUANTITY', 'PRICE',
			],
		]);

		while ($item = $basketRes->fetch()) {
			$arBasketItems[] = $item;
		}
		return $arBasketItems;
	}
}