<!DOCTYPE html>
<html lang="en">
<!-- function to include header .php-->
<?php get_header(); ?>

<div class="grid-container HomePage">
        <!-- Row -->
        <div class="grid-x grid-margin-x small-up-2">
                <?php
                if (have_posts()) {
                        while (have_posts()) {
                                the_post();
                ?>
                                <div class="cell">
                                        <div class="main-post">
                                                <h3 class="post-title">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">


                                                                <?php the_title(); ?>
                                                        </a>
                                                </h3>
                                                <span class="post-author">
                                                        <i class="ph ph-user"></i>
                                                        <?php the_author_posts_link(); ?>
                                                </span>
                                                <span class="post-date">
                                                        <i class="ph ph-calendar"></i>
                                                        <?php the_time('Y/m/d') ?>
                                                </span>
                                                <span class="post-comment">
                                                        <i class="ph ph-chat"></i>
                                                        <?php comments_popup_link('0 comment', 'one->comment', '%->comments', 'comment_url', 'disable-comment'); ?>

                                                </span>
                                                <br>
                                                <p class="categories">
                                                        <i class="ph ph-tag">

                                                        </i><?php the_category(',') ?>
                                                </p>
                                                <?php the_post_thumbnail('', ['class' => 'responsive-img img-thumb', 'title' => 'Featured Image']); ?>

                                                <!-- excerpt -->
                                                <p class="post-content">
                                                        <?php the_excerpt(); ?>

                                                        <!-- tags -->
                                                </p>
                                                <p class="post-tag">
                                                        <?php
                                                        if (has_tag()) {

                                                                the_tags();
                                                        } else {
                                                                echo 'Tags:No Tags';
                                                        }

                                                        ?>;
                                                </p>



                                        </div>
                                </div>
                <?php
                        } // end while
                } // end if
                ?>
        </div>
</div>
<!-- paginate -->

<div class="num_paginate">
        <?php echo master_pagiante_num(); ?>
</div>














<?php get_footer(); ?>