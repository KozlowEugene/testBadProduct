<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?foreach ($arResult['ITEMS'] as $arItem):?>
	<p>
		<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
	</p>
<?endforeach;?>