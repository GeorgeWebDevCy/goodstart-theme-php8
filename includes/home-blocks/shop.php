<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    if (df_is_woocommerce_activated() == true) { // Exit if woocommerce isn't active
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 

    $post_count = $my_query->post_count;
    $counter = 1;
?>
    <?php if($title) { ?>
        <!-- ======== BLOCK TITLE ======== -->
        <div class="block_title">
            <h2> <?php echo esc_html($title);?></h2>
            <?php if($link) { ?>
                <a href="<?php echo esc_url($link);?>" class="view_all"><?php esc_html_e("View all", THEME_NAME);?> <i class="fa fa-folder-open"></i></a>
            <?php } ?>
        </div>
    <?php } ?>
    <!-- Products -->
    <ul class="products four">
        <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <?php 
            $DF_builder->set_double($my_query->post->ID);
            $image = get_post_thumb($my_query->post->ID,0,0); 
            global $product;
        ?>
            <li class="product<?php if($counter==1) { ?> first<?php } else if($counter==$post_count || $counter%4==0) { ?> last<?php } ?>">
                <a href="<?php the_permalink();?>" class="product_item">
                    <?php if( $product && $product->is_on_sale()) { ?>
                         <span class="onsale"><?php esc_html_e("Sale!", THEME_NAME);?></span>
                    <?php } ?>
                    <div class="product_hover">
                        <table>
                            <tr>
                                <td><?php the_title();?></td>
                            </tr>
                        </table>
                    </div>
                    <?php echo df_image_html($my_query->post->ID,450,450);?>
                </a>
                <div class="product_footer">
                    <?php
                        if( $product && $product->get_rating_html()) { 
                            echo balanceTags($product->get_rating_html(), true);
                        } 
                    ?>
                    <?php if( $product && $product->get_price_html()) { ?>
                        <span class="price"><?php echo balanceTags($product->get_price_html(), true);?><span>
                    <?php } ?>
                    <?php  woocommerce_template_loop_add_to_cart(); ?>
                </div>
            </li>
                <?php if($counter%4==0 && $counter!=$my_query->post_count) { ?>
                    </ul>
                    <ul class="products four">
                <?php } ?>
        <?php $counter++; ?>
        <?php endwhile; ?>
        <?php endif; ?>
    </ul><!-- End Products -->
<?php } else { esc_html_e("Please set up WooCommerce Plugin", THEME_NAME); } ?>