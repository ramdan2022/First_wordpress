<?php

if (comments_open()) {
?>
    <h4 class="comments_number"> <?php comments_number('0 comments', '1 comments'); ?> </h4>
    <!-- class container for comments -->
<?php
    echo '<ul class="master_list">';

    $argments =  array(
        'max_depth'  => 2,
        'Type'        => 'comment',
        'avatar_size'       => 70,
    );

    wp_list_comments($argments);

    echo '<hr>';

    //   <!--  comments form -->
    $coments_arg = array(

        'title_reply'  => 'YOUR REPLAY',
        'label_submit'  => 'POST',
        'comment_notes_before' => ""

    );
    comment_form($coments_arg);


    echo '</ul>';
} else {
    echo 'therh is no comment';
}
