<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
			</div><!--end .bx-content -->
	</div><!--end .container.bx-content-section-->
</div><!--end .workarea-->

<footer class="footer" id="footer">
	<div class="container">
		<div class="row">
			<div class="d-flex flex-column align-items-center col-md-3 align-items-md-start">
				<a class="logo-link" href="<?=SITE_DIR?>">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/company_logo_mobile.php"
						),
					false
					);?>
				</a>
				<div class="d-none d-md-block mt-5 mb-3">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/personal.php"
						),
						false
					);?>
				</div>
				<div class="d-none d-md-block mb-3">
					<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/copyright.php"
					), false);?>
				</div>
			</div>
			<div class="d-none d-md-block col-md-6">
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu", 
				"bottom_menu", 
				array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"CACHE_SELECTED_ITEMS" => "N",
					"MAX_LEVEL" => "1",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
					"COMPONENT_TEMPLATE" => "bottom_menu",
					"CHILD_MENU_TYPE" => ""
				),
				false
				);?>
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom_menu",
				array(
					"ROOT_MENU_TYPE" => "bottom",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_TYPE" => "A",
					"CACHE_SELECTED_ITEMS" => "N",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(),
				),
				false
			);?>
			</div>
			

			<div class="d-flex flex-column align-items-center col-md-3 align-items-md-end">
				<div class="mb-3 d-flex align-items-center">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/socnet_footer.php",
							"AREA_FILE_RECURSIVE" => "N",
							"EDIT_MODE" => "html",
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);?>
				</div>
				<div class="mb-3 d-flex align-items-center">
					<span>
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"", array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/telephone.php"
							),
							false
						);?>
					</span>
				</div>
				<div class="mb-3 d-flex align-items-center">
					<span>
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"", array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/mail.php"
							),
							false
						);?>
					</span>
				</div>
				<div class="mb-3  ">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/schedule.php"
						),
						false
					);?>
				</div>
			</div>
		</div>
	</div>
</footer>

	



<script>
	BX.ready(function(){
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});
</script>
</body>
</html>