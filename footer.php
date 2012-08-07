  
  <?php // see if openSUSE official sites. then display Novell copyrights. ?>
  <?php //else display your own copyrights.?>
  <?php if(get_bloginfo('url') === "http://news.opensuse.org" || get_bloginfo('url') === "http://lizards.opensuse.org") {
	 get_remote_snippet('footer');
 } else { ?>
  <div id="footer" class="container_12">
  	<div id="footer-legal" class="border-top grid_12">
  		<p>
  			© <?php the_date('Y'); ?>, <?php bloginfo('name'); ?>.
  			openSUSE and SuSE are trademarks of Novell, Inc. in the United States
  			and other countries.
  		</p>
  	</div>
  </div>
  <?php } ?>
  
  <?php wp_footer();?>
</body>
</html>