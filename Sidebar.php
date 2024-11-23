   <!DOCTYPE html>

   <div class="category_section">
       <h3 class="cat-title"><?php single_cat_title() ?> Statistic</h3>
       <div class="cat_content">
           <ul>
               <li>
                   <span>Coumenst Count</span>:<?php echo Master_Comments_counts() ?>
               </li>
               <li>
                   <?php
                    $cat = get_queried_object(); ?>
                   <!--get post counts  -->
                   <span>articles Count</span>:<?php echo $cat->count ?>
               </li>

           </ul>

       </div>
   </div>

   <div class="category_section">
       <h3 class="cat-title">Advise:posts</h3>
       <div class="cat_content">
           <ul>
               <?php
                $arg = [
                    'cat'            => '3',
                    'posts_per_page' => '3',
                ];

                $querry = new WP_Query($arg);

                if ($querry->have_posts()) {
                    while ($querry->have_posts()) {
                        $querry->the_post();
                ?>


                       <li>
                           <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                       </li>


               <?php

                    }
                }
                ?>
           </ul>


           <div class="category_section">
               <h3 class="cat-title">Hot posts comment</h3>
               <div class="cat_content">
                   <ul>

                       <?php
                        $cat = get_queried_object();

                        $cat_id = $cat->cat_ID; # get id for category
                        // get hot posts 

                        $arg2 = array(
                            'cat'    => $cat_id,
                            'orderby' => 'comment_count',
                        );

                        $Querry = new WP_Query($arg2);



                        if ($Querry->have_posts()) {
                            while ($Querry->have_posts()) {
                                $Querry->the_post();
                        ?>


                               <li>
                                   <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                               </li>


                       <?php

                            }
                        }
                        ?>

                   </ul>
               </div>
           </div>