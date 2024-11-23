<!DOCTYPE html>

<div class="breadcrumb-Holder">
    <div class="container">
        <ol class="breadcrumb">
            <li class="Home">
                <a href="<?php echo get_home_url(); ?>">
                    <?php bloginfo('name'); ?>

                </a>
            </li>
            /
            <li class="Category">
                <a href="
                 <?php
                    // get_the_category(The post ID. Defaults to current post ID.)
                    $all_cats = get_the_category();
                    // url for first cat if the post hase more cat
                    $cat_url = get_category_link($all_cats[0]->term_id);
                    // esc_url() for clean and secure url
                    echo esc_url($cat_url);
                    ?>
                ">
                    <?php echo esc_html($all_cats[0]->name); ?>
                </a>
            </li>
            /
            <li class="active">
                <?php echo get_the_title(); ?>

            </li>


        </ol>
    </div>
</div>>