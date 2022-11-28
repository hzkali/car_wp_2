<!-- Post -->

<article class="post wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">

	<?php if ( has_post_thumbnail() ):?>

	<div class="post-image">

		<?php the_post_thumbnail('carshire8', array('class' => 'img-responsive'));?>

		<div class="caption">

			<div class="date"><span class="day"><?php echo get_the_date('d');?></span><span class="month"><?php echo get_the_date('M');?></span></div>

			<div class="comments"><span class="fa fa-comments"></span> &ensp; <?php comments_number( '0', '1', '%' ); ?></div>

		</div>

		<a href="<?php echo esc_url(get_permalink(get_the_id()));?>" class="overlay"><span class="icon flaticon-right11"></span></a>

	</div>

	<?php endif;?>

	<div class="content-box">

		<h2 class="post-title"><a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_title();?></a></h2>

		<div class="post-info"><?php esc_html_e('Posted on ', 'carshire'); echo get_the_date('F d, Y')?>  / <?php esc_html_e('by', 'carshire');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author();?></a> / <a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments');?>"><?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a></div>

		<div class="post-text"><?php the_excerpt();?></div>

		<div class="text-right"><a class="theme-btn dark-btn" href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php esc_html_e('READ MORE', 'carshire');?></a></div>

	</div>

</article>