<!DOCTYPE html>
<html lang="en">

<?php get_header(); # function to include header

include(get_template_directory() . '/includes/breadcrumb.php');
// include( get_template_directory() . '/includes/breadcrumb.php' );

?>



<div class="grid-container POStPage">
    <!-- Row -->
    <div class="grid-x grid-margin-x small-up-2">

        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>

                <div class="main-post ">
                    <?php edit_post_link('Edit<i class="ph ph-pencil-simple"></i>'); ?>

                    <!-- post title -->
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">


                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <span class="post-author">
                        <i class="ph ph-user"></i>
                        <?php the_author_posts_link(); ?>
                    </span>
                    <!--post date  -->
                    <span class="post-date">
                        <i class="ph ph-calendar"></i>
                        <?php the_time('Y/m/d') ?>
                    </span>
                    <!--post comment  -->
                    <span class="post-comment">
                        <i class="ph ph-chat"></i>
                        <?php comments_popup_link('0 comment', 'one->comment', '%->comments', 'comment_url', 'disable-comment'); ?>

                    </span>
                    <br>
                    <!--post categories  -->
                    <p class="categories">
                        <i class="ph ph-tag">

                        </i><?php the_category(',') ?>
                    </p>
                    <!--post image  -->

                    <?php the_post_thumbnail('', ['class' => 'responsive-img img-thumb', 'title' => 'Featured Image']); ?>

                    <p class="post-content">

                        <?php the_content(''); ?>

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
                    <!-- break -->
                    <hr style="height:5px;border:none;color:#333;background-color:#333;">

                    <!--Post Author  -->
                    <!-- img -->

                    <?php
                    $args = array(
                        'class' => 'responsive-img img-thumb',
                    );
                    // echo get_avater('id',size,default avatar image,text_for_noImage,$array for image dymension)
                    echo  get_avatar(get_the_author_meta('ID'), 65, '', 'no Image', $args)
                    ?>
                    <!-- information about author -->
                    <h4 style="color:darkslateblue;">
                        <?php echo 'created By:'; ?>
                        <?php the_author_meta('first_name'); //get author first name 
                        ?>
                        <?php the_author_meta('last_name');   //get author last name
                        ?>
                        (<?php the_author_meta('nickname'); //get author nickname 
                            ?>)
                    </h4>

                    <p>
                        <?php
                        // echo get_author_meta
                        if (get_the_author_meta('description')) {
                            the_author_meta('description'); //get author descreption
                        } else {
                            echo 'New Author';
                        }
                        ?>

                    </p>
                    <!-- more information about author and count comments -->

                    <!-- count_user_posts(author_id,posts type,public only[false] )-->

                    <i class="ph ph-list-numbers" style="font-size: 18px; color:brown"></i> Posts By author :<?php echo count_user_posts(get_the_author_meta('ID')); ?>
                    <br>

                    <i class="ph ph-arrow-fat-lines-right" style="font-size:18px; color:black"></i></i>Author Page::<?php the_author_posts_link(); ?>


                    <p>
                        <!-- include comments file -->
                        <?php comments_template(); ?>
                    </p>




                </div>

        <?php
            } // end while
        } // end if
        ?>
    </div>
</div>

<?php


// paginate

echo '<div class="Post-paginate">';
// pervious
if (get_previous_post_link()) {

    previous_post_link('%link', '<i class="ph ph-arrow-fat-left large"></i> %title');
} else {
    echo '<span> No More Post previous </span>';
}

//Next 

if (get_next_post_link()) {

    echo
    next_post_link('%link', '%title <i class="ph ph-arrow-fat-right large"></i>');
} else {
    echo '<span>No More Post next</span>';
}


echo '</div>';
?>






<?php get_footer(); ?>