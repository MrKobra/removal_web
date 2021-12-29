<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package removal
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$boundary_price = get_boundary_price($args['query']);
$boundary_length = get_boundary_attribute($args['query'], 'pa_dlina');
$boundary_width = get_boundary_attribute($args['query'], 'pa_shirina');
$boundary_height = get_boundary_attribute($args['query'], 'pa_vysota');
?>

<aside class="catalog-sidebar">
    <div class="mobile-filter-btn">
        <span>Фильтр</span>
    </div>
    <?php
    $args = [
        'taxonomy'      => 'product_cat',
        'orderby'       => 'id',
        'order'         => 'DESC',
        'parent'        => 0,
        'hide_empty'    => true,
        'exclude'       => array(22),
        'update_term_meta_cache' => true,
    ];

    $terms = get_terms( $args );

    if($terms):
    ?>
    <div class="catalog-sidebar_cat">
        <div class="catalog-sidebar_heading">
            <h3>Категории товаров</h3>
        </div>
        <ul>
            <?php foreach($terms as $term): ?>
                <li><a href="<?php echo get_term_link($term->term_id) ?>"><?php echo $term->name; ?> <span><?php echo $term->count; ?></span></a></li>
            <?php
            endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="catalog-sidebar_filter">
        <div class="catalog-sidebar_heading">
            <h3>Фильтр товаров</h3>
        </div>
        <div class="catalog-sidebar-block catalog-sidebar-slider">
            <div class="catalog-sidebar-header">
                Цена, ₽
            </div>
            <div class="catalog-sidebar-body">
                <p>
                            <span>
                                <input type="number" name="min_price" value="<?php if(isset($_GET['min_price'])) { echo $_GET['min_price']; } else { echo $boundary_price[0]; } ?>">
                            </span>
                    <span>
                                <input type="number" name="max_price" value="<?php if(isset($_GET['max_price'])) { echo $_GET['max_price']; } else { echo $boundary_price[1]; } ?>">
                            </span>
                </p>
                <div class="catalog-slider" data-max="<?php echo $boundary_price[1]; ?>" data-min="<?php echo $boundary_price[0]; ?>" id="price-slider"></div>
            </div>
        </div>
        <div class="catalog-sidebar-block catalog-sidebar-slider">
            <div class="catalog-sidebar-header">
                Длина, мм
            </div>
            <div class="catalog-sidebar-body">
                <select name="length_range" id="length_range">
                    <?php
                    foreach($boundary_length[2] as $key => $value) {
                        ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <p>
                    <?php
                    if(isset($_GET['length'])) {
                        $cur = explode(',', $_GET['length']);
                        $max = (int)max($boundary_length[2]);
                        $min = (int)min($boundary_length[2]);
                    }
                    ?>
                    <span>
                                <input type="number" data-id="<?php echo get_key($boundary_length[2], $boundary_length[0]); ?>" name="min_length" value="<?php if(isset($_GET['length'])) { echo $min; } else { echo $boundary_length[0]; } ?>">
                            </span>
                    <span>
                                <input type="number" data-id="<?php echo get_key($boundary_length[2], $boundary_length[1]); ?>" name="max_length" value="<?php if(isset($_GET['length'])) { echo $max; } else { echo $boundary_length[1]; } ?>">
                            </span>
                </p>
                <div class="catalog-slider" data-max="<?php echo $boundary_length[1]; ?>" data-min="<?php echo $boundary_length[0]; ?>" id="length-slider"></div>
            </div>
        </div>
        <div class="catalog-sidebar-block catalog-sidebar-slider">
            <div class="catalog-sidebar-header">
                Ширина, мм
            </div>
            <div class="catalog-sidebar-body">
                <select name="width_range" id="width_range">
                    <?php
                    foreach($boundary_width[2] as $key => $value) {
                        ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <p>
                    <?php
                    if(isset($_GET['width'])) {
                        $cur = explode(',', $_GET['width']);
                        $max = (int)max($boundary_width[2]);
                        $min = (int)min($boundary_width[2]);
                    }
                    ?>
                    <span>
                                <input type="number" data-id="<?php echo get_key($boundary_width[2], $boundary_width[0]); ?>" name="min_width" value="<?php if(isset($_GET['width'])) { echo $min; } else { echo $boundary_width[0]; } ?>">
                            </span>
                    <span>
                                <input type="number" data-id="<?php echo get_key($boundary_width[2], $boundary_width[1]); ?>" name="max_width" value="<?php if(isset($_GET['width'])) { echo $max; } else { echo $boundary_width[1]; } ?>">
                            </span>
                </p>
                <div class="catalog-slider" data-max="<?php echo $boundary_width[1]; ?>" data-min="<?php echo $boundary_width[0]; ?>" id="width-slider"></div>
            </div>
        </div>
        <div class="catalog-sidebar-block catalog-sidebar-slider">
            <div class="catalog-sidebar-header">
                Высота, мм
            </div>
            <div class="catalog-sidebar-body">
                <select name="height_range" id="height_range">
                    <?php
                    foreach($boundary_height[2] as $key => $value) {
                        ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <p>
                    <?php
                    if(isset($_GET['height'])) {
                        $cur = explode(',', $_GET['height']);
                        $max = (int)max($boundary_height[2]);
                        $min = (int)min($boundary_height[2]);
                    }
                    ?>
                    <span>
                                <input type="number" data-id="<?php echo get_key($boundary_height[2], $boundary_height[0]); ?>" name="min_height" value="<?php if(isset($_GET['height'])) { echo $min; } else { echo $boundary_height[0]; } ?>">
                            </span>
                    <span>
                                <input type="number" data-id="<?php echo get_key($boundary_height[2], $boundary_height[1]); ?>" name="max_height" value="<?php if(isset($_GET['height'])) { echo $max; } else { echo $boundary_height[1]; } ?>">
                            </span>
                </p>
                <div class="catalog-slider" data-max="<?php echo $boundary_height[1]; ?>" data-min="<?php echo $boundary_height[0]; ?>" id="height-slider"></div>
            </div>
        </div>
        <?php
        if(get_field('filter_attribute', 'options')) {
            while(has_sub_field('filter_attribute', 'options')) {
                $slug = get_sub_field('slug');
                $args = [
                    'taxonomy'      => 'pa_'.$slug,
                    'orderby'       => 'id',
                    'order'         => 'ASC',
                    'hide_empty'    => false,
                    'update_term_meta_cache' => true,
                    'meta_query'    => '',
                ];

                $terms = get_terms( $args );
                if($terms):
                    $i = 0; ?>
                    <div class="catalog-sidebar-block catalog-sidebar-checkbox <?php if(isset($_GET[$slug])) { echo 'active'; } ?>">
                        <div class="catalog-sidebar-header">
                            <?php $label = get_taxonomy_labels(get_taxonomy('pa_'.$slug)); ?>
                            <span><?php echo $label->singular_name; ?></span>
                        </div>
                        <div class="catalog-sidebar-body" <?php if(isset($_GET[$slug])) { echo 'style="display: block"'; } ?>>
                            <?php foreach($terms as $term) :
                                $i++; ?>
                                <div class="catalog-sidebar-row">
                                    <label for="<?php echo $slug.'_'.$i; ?>"><?php echo $term->name; ?></label>
                                    <input <?php if(isset($_GET[$slug]) && $_GET[$slug] == $term->term_id) { echo 'checked="checked"'; } ?> type="checkbox" name="<?php echo $slug; ?>" value="<?php echo $term->term_id; ?>" id="<?php echo $slug.'_'.$i; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif;
            }
        }
        $stock_status = ['instock' => 'В наличии', 'outofstock' => 'Нет в наличии', 'onbackorder' => 'Предзаказ'];
        ?>
        <div class="catalog-sidebar-block catalog-sidebar-checkbox <?php if(isset($_GET['stock_status'])) { echo 'active'; } ?>">
            <div class="catalog-sidebar-header">
                <span>Наличие</span>
            </div>
            <div class="catalog-sidebar-body" <?php if(isset($_GET['stock_status'])) { echo 'style="display: block"'; } ?>>
                <?php
                $i = 0;
                foreach($stock_status as $key => $value):
                    $i++; ?>
                <div class="catalog-sidebar-row">
                    <label for="<?php echo 'stock_status_'.$i; ?>"><?php echo $value; ?></label>
                    <input <?php if(isset($_GET['stock_status']) && $_GET['stock_status'] == $key) { echo 'checked="checked"'; } ?> type="checkbox" name="<?php echo 'stock_status'; ?>" value="<?php echo $key; ?>" id="<?php echo 'stock_status_'.$i; ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="catalog-sidebar-block catalog-sidebar-btn">
            <div class="catalog-sidebar-body">
                <a href="#" class="btn filter_btn">Показать</a>
                <a href="#" class="btn reset_btn">Очистить</a>
            </div>
        </div>
    </div>
</aside>