<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CBadProduct extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		if ($arParams['QUANTITY']) {
			$arParams['QUANTITY'] = (int)$arParams['QUANTITY'];
		} else {
			$arParams['QUANTITY'] = 2;
		}
		if ($arParams['COUNT_DAY']) {
			$arParams['COUNT_DAY'] = (int)$arParams['COUNT_DAY'];
		} else {
			$arParams['COUNT_DAY'] = 7;
		}
		return $arParams;
	}

	public function executeComponent() {
		if ($this->startResultCache()) {
			$this->arResult['ITEMS'] = BadProduct::getItems($this->arParams['QUANTITY'], $this->arParams['COUNT_DAY']);

			$this->includeComponentTemplate();
		}
		return $this->arResult;
	}

}
