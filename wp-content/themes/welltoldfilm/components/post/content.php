<?php
  /**
   * Template part for displaying posts.
   *
   * @link https://codex.wordpress.org/Template_Hierarchy
   *
   * @package WellToldFilm
   */
  
  ?>
<?php
  if ( is_single() ) : ?>
'
<div class="col-xs-12 col-s-12 col-md-12 col-lg-12">
<?php else : ?>
<div class="col-xs-12 col-s-6 col-md-4 col-lg-3">
  <?php endif; ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( '' != get_the_post_thumbnail() ) : ?>
    <div class="post-thumbnail">
      <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail( 'welltoldfilm-featured-image' ); ?>
      </a>
    </div>



    <!-- VIDEO-->
    <?php endif; 
      if( get_post_type() == 'video') : ?>
    <div class="video_post">
      <video controls="control" preload="none">
        <source src="<?php
          $mykey_values = get_post_custom_values( '_video_url' );
          foreach ( $mykey_values as $key => $value ) {
            echo "$value"; 
          }
          ?>" type="video/youtube">
      </video>
        <header class="entry-header">
          <?php
            if ( is_single() ) {
              the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
              the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }
          ?>
          
       </header>
    </div>
      <?php elseif(get_post_type() == 'web') : ?>


    <!-- WEB-->
    <div class="web_post">
      <?php
        $mykey_values = get_post_custom_values( '_web_url' );
        foreach ( $mykey_values as $key => $value ) {
          echo "$value <br />"; 
        }
        ?>
      <div class="entry-content">
        <?php
          the_content( sprintf(
            /* translators: %s: Name of current post. */
            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'welltoldfilm' ), array( 'span' => array( 'class' => array() ) ) ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
          ) );
          
          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'welltoldfilm' ),
            'after'  => '</div>',
          ) );
          ?>
      </div>
      <header class="entry-header">
      <?php
        if ( is_single() ) {
          the_title( '<h1 class="entry-title">', '</h1>' );
        } else {
          the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }
      ?>
          
      </header>
      <?php
        
        if ( 'post' === get_post_type() ) : ?>
      <?php get_template_part( 'components/post/content', 'meta' ); ?>
      <?php
        endif; ?>
    </div>
    <?php endif; ?> 
    <?php get_template_part( 'components/post/content', 'footer' ); ?>
  </article>
  <!-- #post-## -->
</div>