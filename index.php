<?php get_header(); ?>

<!-- Start: Main Content Area -->
<div id="content" class="container_16 content-wrapper">
  <!-- <div id="highlight-wrapper" class="box box-shadow grid_12 alpha">

    <?php #if(is_home()) : ?>
    <?php #if(function_exists("insert_post_highlights")) insert_post_highlights(); ?>
    <?php #endif; ?>

  </div> -->
  
  <div class="box box-shadow grid_12 alpha main">

    <!-- <div id="test" style="background-color: #111; height: 6px; overflow: hidden; margin-top: -15px; -moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px;"> </div> -->
    <?php if(is_home()) : ?>
    <?php if(function_exists("insert_post_highlights")) insert_post_highlights(); ?>
    <?php endif; ?>
    
    <?php if (have_posts()) : ?>

      <?php while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?> </small>

	  <div class="share-links">
		<div class="share-link">
			<a href="http://v.t.sina.com.cn/share/share.php?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" title="分享到新浪微博"><img src="http://weibo.com/favicon.ico"/></a>
		</div>
		<div class="clearfix"></div>
	  </div>
          
          <div class="entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
          </div>

          <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
        </div>

      <?php endwhile; ?>

      <div class="navigation page-navigation">
        <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
        <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
      </div>

    <?php else : ?>

      <h2 class="center">Not Found</h2>
      <p class="center">Sorry, but you are looking for something that isn't here.</p>
      <?php get_search_form(); ?>

    <?php endif; ?>

  </div>

  <?php get_sidebar(); ?>

</div>
<!-- End: Main Content Area -->

<?php get_footer(); ?>
