<!DOCTYPE html>
<lang="en">
    <!-- function to include header .php-->
    <?php get_header(); ?>


    <div class="grid-container POStPage category">
        <div class="grid-x grid-margin-x small-up-2">

            <div class="cat_info">
                <!--single_cat_title() to get cat title-->
                <h3 class="cat_titile"><?php single_cat_title('Title is : '); ?></h3>
                <div class="cat_descreption">
                    <?php echo category_description(); ?>
                </div>

                <div class="cat_status">
                    <span>Articles Count:10</span>
                    <span>Comments Count: 20</span>
                    </h4>
                    <!-- end row -->
                </div>
            </div>
            <?php


            //get post id
            global $post;
            // get_queried_object_id() retrive id of the current post  


            //  get Id for category
            // get_query_var() Retrieves the value of a query variable in the WP_Query class.
            $category = get_category(get_query_var('cat'));
            $cat_id = $category->cat_ID;
            // wp_get_post_categories(get_queried_object_id($post)) to get category id

            $custom_arg = array(
                'category__in'     => $cat_id,
                'posts_per_page'    => -1,
                'orderby'           => 'rand',
                'post__not_in'      => array(get_queried_object_id($post)), # get post id  global $post;




            );

            $category_posts = new WP_Query($custom_arg);
            if ($category_posts->have_posts()) {



                while ($category_posts->have_posts()) {
                    $category_posts->the_post();
            ?>
                    <div class="grid-x grid-margin-x ">
                        <div class="small-2 cell">
                            <?php the_post_thumbnail('', ['class' => 'responsive-img img-thumb', 'title' => 'Featured Image']); ?>
                        </div>

                        <!-- Row -->

                        <div class="small-10 cell">

                            <h3 class="post-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">

                                    <!--wp_trim_word(Text,number,...) trim texts -->
                                    <?php echo wp_trim_words(get_the_title(), 2); ?>
                                </a>
                            </h3>

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



                            <p class="post-content">
                                <?php the_excerpt(10); ?>


                                <!-- tags -->
                            </p>




                        </div>
                    </div>

                    <!-- Clearfix to ensure rows are separated properly -->
                    <div class="clearfix"></div>
            <?php
                } // end while
            } // end if
            ?>

            <!-- restore the post querry to the default before using wp_query -->
            <?php wp_reset_postdata(); ?>




















        </div>
    </div>

    <?php get_footer(); ?>