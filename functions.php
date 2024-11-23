<?php
require_once('F6_TOPBAR_MENU_WALKER.php');


#function to  show menu in body after header


/*
function to add my custom style .css file
created by @mohamedRamdan 
*/
function master_style()
{
    wp_enqueue_style('main_css', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('found_style_css', get_template_directory_uri() . '/css/foundation.min.css');
    wp_enqueue_style('phosphor_logo_css', get_template_directory_uri() . '/fonts/regular/style.css');
}

/*
function to add my custom scipt.js file
created by @mohamedRamdan 
*/
function master_script()

{
    // deregister jquery to put it in footer right place after register
    wp_deregister_script('jquery');
    wp_register_script('jquery', includes_url() . 'js/jquery/jquery.js', array(), false, true); // re-register jquery
    // enqueue jquery put in the list 
    wp_enqueue_script('jquery');

    wp_enqueue_script('main_js', get_template_directory_uri() . '/js/main.js', array(), false, true);

    #if i work with old version of ide i put this code but this code for leaning wp_script_data
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/htnl5shiv.js');

    wp_script_add_data('html5shiv', 'conditional', 'lt IE 11');

    wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.js');
    wp_script_add_data('respond', 'conditional', 'lt IE 11');
}

/*
function to  create custome menu 
by @ ramdan 2024
*/
function master_menu()
{
    register_nav_menus(array(
        'found_menu' => __('Navigation_Bar'),
        'footer_menu' => __('footer')
    ));  # create custome menu position navigation bar
}

// function to show more than ome menu
function Show_nav()
{
    wp_nav_menu(array(
        'theme_location'  => 'found_menu',
        'menu_class'      => 'menu',
        'container'       => false,
        'depth'           => '2',
        'walker'          => new F6_TOPBAR_MENU_WALKER(),


    ));
}

add_theme_support('post-thumbnails'); // function to add featured Image


// function to change num of excerpt word
function master_extend_excerpt_length($lenght)
{
    if (is_author()) {
        return 5;
    } elseif (is_category()) {
        return 10;
    }
    return 25;
}

// function to change  excerpt more icone
function master_extend_excerpt_more()
{
    return '..Read more';
}


// custome function for number pagination

// wp_querry is instanse of wp_querry
function master_pagiante_num()
{
    global $wp_query;

    $all_pages = $wp_query->max_num_pages;

    $current_page = max(1, get_query_var('paged'));

    if ($all_pages > 1) {
        // paginate_links() Retrieves paginated links for archive post pages.

        /*‘base’ argument is "http://example.com/all_posts.php%_%" and the ‘%_%’ is required. 
        The ‘%_%’ will be replaced by the contents of in the ‘format’ argument.
         An example for the ‘format’ argument is "?page=%#%" and the ‘%#%’ is also required.
          The ‘%#%’ will be replaced with the page number.*/
        return paginate_links(array(
            'base'        => get_pagenum_link() . '%_%',
            'format'      => 'page/%#%',
            'total'       => $all_pages,
            'current'     => $current_page,
            'mid_size'    => 1,
            'end_size'    => 1,
            'prev_text'   => '<<',
            'next_text'   =>  '>>'




        ));
    }
}

/*create 
    sidebar to add widgets */

function master_sidebar()
{
    register_sidebar(array(
        'name'          => 'Main Sidebar',
        'id'            => 'main-sidebar',
        'description'   => 'Main side bar appear everywear',
        'class'         => 'Main_sidebar',
        'before_widget' => '<div class="widget-content">',
        'after_widget'  => '</div>',
        'before_title ' => '<h3 class="widget_tittle">',
        'after_title'   => '</h3>',

    ));
}

// funtion to get comments counts for cat page
// by get comment for post and make sure this post in cat

function Master_Comments_counts()
{
    $comments_arg = [
        'status'   => 'approve'
    ];

    $all_comments = get_comments($comments_arg);

    $comments_couts = 0;

    foreach ($all_comments as $comment) {

        // id for post
        $post_id = $comment->post_id;

        // in_category(cat name,post id) check post in cat or not 
        if (! in_category('games', $post_id)) {

            continue;
        } else {
            $comments_couts++;
        }
    }

    return $comments_couts;
}

// function to remove default <p>

function master_content_NoAutop($content)
{

    remove_filter('the_content', 'wpautop');

    return $content;
}


/* 
function action file to add mycustom function 
into hook tp excute
created by @mohamedRamdan 
*/
add_action('wp_enqueue_scripts', 'master_style'); # action style in file wp_enqueue_scripts

add_action('wp_enqueue_scripts', 'master_script');

add_action('init', 'master_menu'); #// function action to create menu

add_action('widgets_init', 'master_sidebar'); #function to add sidebar 


/* 
function filter 
created by @mohamedRamdan 
*/

add_filter('excerpt_length', 'master_extend_excerpt_length');
add_filter('excerpt_more', 'master_extend_excerpt_more');

add_filter('the_content', 'master_content_NoAutop', 0); #function to add my filter to remove autop
