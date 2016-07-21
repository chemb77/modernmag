<?php require(WEBTREATS_INCLUDES . "/var.php"); ?>
<div class="clearboth"></div>
</div><!-- inner -->								
</div><!-- body_block -->
<div id="footer">
	<div class="background">

		
	</div><!-- background -->
</div><!-- footer -->


<div id="sub_footer">
	<div class="inner">
		<div class="one_half"><?php echo stripslashes($footer_text); ?></div>				
			<div class="one_half last" style="text-align:right;">
				<div id="footer_nav">
					<?php if($footer_include) { ?>
					<ul>
						<?php wp_list_pages("depth=0&sort_column=menu_order&include=$footer_include&title_li="); ?>
					</ul>
					<?php } ?>
				</div>
			</div>											

<div class="clearboth"></div>
	
	</div><!-- inner -->							
</div><!-- sub_footer -->

<?php wp_footer(); ?>
<script type="text/javascript">Cufon.now();</script>
<?php if ( $analytics_code <> "" ) { echo stripslashes($analytics_code); } ?>
<script type="text/javascript">
/* <![CDATA[ */
function expandIt(getIt){getIt.style.display=(getIt.style.display=="none")?"":"none";}
/* ]]> */
</script>
</body>
</html>