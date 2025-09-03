<?php
/**
	* Template Name: Frontpage
*/

get_header(); 

get_template_part('template-parts/sections/section','banner');
get_template_part('template-parts/sections/section','products');
get_template_part('template-parts/sections/section','content'); ?>

<?php get_footer(); ?>