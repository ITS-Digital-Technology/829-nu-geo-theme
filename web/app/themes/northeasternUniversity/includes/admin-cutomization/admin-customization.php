<?php
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
  .mce-menu-item .mce-text i,
  .mce-txt i{
      display:inline-block!important;
      margin-right: 3px;
      font-family: "iconfont-northeasternUniversity";
    }
  </style>';
}


// add_action('admin_enqueue_scripts', 'custom_js');
// function custom_js() {
//     if( is_admin() ) {
//         $arr=[];
//         $path =get_template_directory_uri() . /cs
//         $files = scandir($path, 1);
//         print_r($files);
//         // wp_localize_script('jstheme', 'loaded', $arr);
//     }
// }

// add_action( 'wp_footer', 'scriptsloades');
// function scriptsloades() {
//     wp_enqueue_script( 'jstheme', get_template_directory_uri() . '/js/theme.js#asyncload' ,[], false, true);
//     $arr = loadScripts(false, true);
//     wp_localize_script('jstheme', 'loaded', $arr);
// };


// add_action('admin_enqueue_scripts', 'custom_js');
// function custom_js() {
//     if( is_admin() ) {
//         $dir_path = 'C:/xampp/htdocs/projects/northeastern-university-global-experience-yvq2szzh/src/app/themes/northeasternUniversity/icons/';
//         // $r = explode('/', str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', __DIR__));
//         // $sitepath = $_SERVER['DOCUMENT_ROOT'] . '/' . $r[0];
//         // var_dump($sitepath);
//         $files = scandir($dir_path, 1);
//         // var_dump($path);
//         print_r($files);
//         // if(is_dir($dir_path)){
//         //     $files=opendir($dir_path);
//         //     if($files){
//         //         while(($file_name=readdir($files)) !== FALSE){
//         //             echo $file_name;
//         //         }
//         //     }
//         // }else{
//         //     echo 'nodsaaaaaaaaaaaaaaaaaaaaaaa';
//         // }
//         wp_localize_script('jstheme', 'iconfiles', $files);
//     }
// }

// add_action( 'wp_footer', 'scriptsloades');
// function scriptsloades() {
//     wp_enqueue_script( 'jstheme', get_template_directory_uri() . '/js/theme.js#asyncload' ,[], false, true);
//     $arr = loadScripts(false, true);
//     wp_localize_script('jstheme', 'loaded', $arr);
// };
