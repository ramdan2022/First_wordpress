<!DOCTYPE html>
<html lang="en">
<!-- function to include header.php -->
<?php get_header(); ?>

<div class="grid-container POStPage Custome_cat">
    <div class="grid-layout">
        <!-- Main Content -->
        <div class="main-content">
            <div class="cu_cat_info">
                <h3 class="cat_title"><?php single_cat_title('This is custom page: '); ?></h3>
                <?php
                $cat = get_queried_object(); ?>

                <p class="cat_status">Articles Count:<?php echo $cat->count ?>

                    Comments Count:<?php echo Master_Comments_counts() ?></p>
                <div class="cat_des">
                    <?php echo category_description(); ?>
                </div>
            </div>

            <!-- Fetch and display posts -->
            <?php
            global $post;
            $category = get_category(get_query_var('cat'));
            $cat_id = $category->cat_ID;

            $custom_arg = array(
                'category__in'     => $cat_id,
                'posts_per_page'    => -1,
                'orderby'           => 'rand',
                'post__not_in'      => array(get_queried_object_id($post)),
            );

            $category_posts = new WP_Query($custom_arg);
            if ($category_posts->have_posts()) {
                while ($category_posts->have_posts()) {
                    $category_posts->the_post();
            ?>
                    <div class="post-item">
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('', ['class' => 'responsive-img img-thumb', 'title' => 'Featured Image']); ?>
                        </div>

                        <div class="post-details">
                            <h3 class="post-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                    <?php echo wp_trim_words(get_the_title(), 2); ?>
                                </a>
                            </h3>
                            <span class="post-date"><?php the_time('Y/m/d') ?></span>
                            <span class="post-comment">
                                <?php comments_popup_link('0 comment', 'one comment', '% comments'); ?>
                            </span>
                            <p class="categories"><?php the_category(',') ?></p>
                            <p class="post-content"><?php the_excerpt(); ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            wp_reset_postdata();
            ?>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <?php if (is_active_sidebar('main-sidebar')) {
                get_sidebar();
            } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>