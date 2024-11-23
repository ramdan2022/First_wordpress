<!DOCTYPE html>
<html lang="en">
<!-- function to include header .php-->
<?php get_header(); ?>
<div class="grid-container author-page">

    <!-- Row -->
    <h1 class="au_title">Author Page</h1>
    <div class="infor">
        <div class="grid-x grid-margin-x small-up-2">

            <!-- image -->
            <?php
            $args = array(
                'class' => 'responsive-img img-thumb',
            );
            // echo get_avater('id',size,default avatar image,text_for_noImage,$array for image dymension)
            echo  get_avatar(get_the_author_meta('ID'), 100, '', 'no Image', $args)
            ?>

            <!-- name -->
            <h2>
                <?php the_author_meta('first_name'); //get author first name 
                ?>
                <?php the_author_meta('last_name');   //get author last name
                ?>
            </h2>

            <!-- descreption -->
            <p class="description">
                <?php
                // echo get_author_meta
                if (get_the_author_meta('description')) {
                    echo wp_trim_words(get_the_author_meta('description'), 6);
                } else {
                    echo 'New Author';
                }
                ?>

            </p>

        </div>

        <!-- end Row -->


    </div>

    <!-- row -->

    <div class="grid-x grid-margin-x small-up-2">

        <!-- get posts counts -->
        <div class="posts">
            <h3>Posts</h3>
            <h3><?php echo count_user_posts(get_the_author_meta('ID')); ?></h3>
        </div>


        <div class="comments">
            <h3>Comments</h3>
            <?php
            $arg = array(
                'user_id' => get_the_author_meta('ID'),
                'count'         => true,

            );
            ?>

            <h3> <?php echo get_comments($arg); ?></h3>

        </div>

        <div class="posts_view">
            <h3> Posts View</h3>


        </div>

        <div class="Testing">
            <h3>Testing</h3>

        </div>
        <div clss="row">
            <?php

            // class WP_Query form retrive any custome querry for posts

            $custom_arg = array(
                'author'  => get_the_author_meta('ID'),
                'posts_per_page' => -1
            );
            // conditition to know if there is posts or not 
            $author_posts = new WP_Query($custom_arg);
            if ($author_posts->have_posts()) { ?>

                <h3 class="author_posts"> Posts Of : <?php the_author_meta('nickname'); ?></h3>
                <?php
                while ($author_posts->have_posts()) {
                    $author_posts->the_post();

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
        <br>
        <!-- SHOW comments  -->
        <div class="show_comments">

            <h3 class="comments_section"> Last : <?php the_author_meta('nickname'); ?> comments</h3>

            <?php

            $comments_arguments = array(
                'user_id' =>  get_the_author_meta('ID'),
                'status'  =>  'approve',
                'number'  =>  4,
                'post_type'    => 'post',
                'count'   =>  false,

            );

            $comments = get_comments($comments_arguments);

            if ($comments) {

                foreach ($comments as $comment) {
            ?>

                    <h4 class="comment_title">
                        <a href="<?php the_permalink(); ?>">

                            <?php echo get_the_title($comment->comment_post_ID); ?>
                        </a>
                    </h4>

                    <span class="comment_date">
                        <i class="ph ph-calendar"></i>
                        <?php echo mysql2date('d/m/y|h:i', $comment->comment_date); ?>
                    </span>

                    <div class="comment_content">
                        <?php echo $comment->comment_content . '<br>'; ?>
                    </div>
                    <hr>

            <?php
                }
            } else {
                echo the_author_meta('nickname') . '  Has No Comments';
            }
            ?>





        </div>






    </div>
</div>

<?php get_footer(); ?>