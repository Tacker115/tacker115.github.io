<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));

\Bitrix\Main\UI\Extension::load("ui.bootstrap4");

if (isset($_GET["theme"]) && in_array($_GET["theme"], array("blue", "green", "yellow", "red")))
{
	COption::SetOptionString("main", "wizard_eshop_bootstrap_theme_id", $_GET["theme"], false, SITE_ID);
}
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "green", SITE_ID);

$curPage = $APPLICATION->GetCurPage(true);

?><!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700;900&display=swap" rel="stylesheet">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<? $APPLICATION->ShowHead(); ?>
	<?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/bootstrap.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/style.css");
   
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/bootstrap.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/slick.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/script.js');
    ?>
</head>
<body class="bx-background-image bx-theme-<?=$theme?>" id="body">

<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<?$APPLICATION->IncludeComponent(
	"bitrix:eshop.banner",
	"",
	array()
);?>

<header class="header" id="header">
	<div class="container">
		<div class="row">
			<div class="col-10 col-md-3">
				<a class="logo-link" href="<?=SITE_DIR?>">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/company_logo.php"),
						false
						);?>
				</a>
			</div>
			<div class="col-2 d-md-none d-flex justify-content-end">
				<button class="nav-toggle" id="nav_toggle" type="button">
					<span class="nav-toggle__item">Menu</span>
				</button>
	    	</div>

			<!--region menu-->
			<div class="order-4 order-md-2 col-md-6">
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu", 
					"horizontal_multilevel", 
					array(
						"ROOT_MENU_TYPE" => "left",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_THEME" => "site",
						"CACHE_SELECTED_ITEMS" => "N",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "3",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N",
						"COMPONENT_TEMPLATE" => "horizontal_multilevel"
					),
					false
				);?>
			</div>
			<!--endregion-->

			<div class="d-none d-md-block order-md-3 col-md-3">
				<div class="header-info">
					<div class="phone">
						<a href="tel:+7(495)8235412">
							<button class="callback" type="button">
								<img class="callback-icon" src="<?=SITE_TEMPLATE_PATH?>/images/callback.svg" alt="">
							</button>
						</a>
						<a class="number" href="tel:+7(495)8235412">
						+7(495) 823-54-12
						</a>
					</div>
					<div class="icons-header">
						<?$APPLICATION->IncludeComponent(
							"bitrix:sale.basket.basket.line",
							"bootstrap_v4_edit",
							array(
								"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
								"PATH_TO_PERSONAL" => SITE_DIR."personal/",
								"SHOW_PERSONAL_LINK" => "N",
								"SHOW_NUM_PRODUCTS" => "Y",
								"SHOW_TOTAL_PRICE" => "N",
								"SHOW_PRODUCTS" => "Y",
								"POSITION_FIXED" =>"N",
								"SHOW_AUTHOR" => "N",
								"PATH_TO_REGISTER" => SITE_DIR."login/",
								"PATH_TO_PROFILE" => SITE_DIR."personal/"
							),
							false,
							array()
						);?>
					</div>
				</div>
			</div>
			
		</div>
		<!--endregion-->
	</div>
</header>


<div class="workarea">
	<div class="container bx-content-section">
		<div class="row">
		<!--region search.title -->

		<!--endregion-->

		<!--region breadcrumb-->
		<?if ($curPage != SITE_DIR."index.php"):?>
			<div class="row mb-4 mtr-4">
				<div class="col" id="navigation">
					<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"universal",
						array(
							"START_FROM" => "0",
							"PATH" => "",
							"SITE_ID" => "-"
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);?>
				</div>
			</div>
			<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>
		<?endif?>
		<!--endregion-->