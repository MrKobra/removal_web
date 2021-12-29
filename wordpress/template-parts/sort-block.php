<?php
$post_count = [15, 30, 45, 60];
$current = 1;
if(isset($_GET['count'])) {
    $current = $_GET['count'];
}
?>
<div class="catalog-sort_wrapper">
    <div class="mobile-filter-btn">
        <span>Фильтр</span>
    </div>
    <div class="catalog-sort">
        <span>Выводить по:</span>
        <select name="items-count" id="items-count">
            <?php foreach($post_count as $count) { ?>
                <option <?php if($current == $count) { echo 'selected="selected"'; } ?> value="<?php echo $count; ?>"><?php echo $count; ?></option>
            <?php } ?>
        </select>
        <select name="catalog-sort" id="catalog-sort">
            <option <?php if(!isset($_GET['sort'])) { echo 'selected="selected"'; } ?> value="none">По умолчанию</option>
            <option <?php if(isset($_GET['sort'])) { if($_GET['sort'] == 'DESC') { echo 'selected="selected"'; } } ?> value="DESC">по убыванию цены</option>
            <option <?php if(isset($_GET['sort'])) { if($_GET['sort'] == 'ASC') { echo 'selected="selected"'; } } ?> value="ASC">по возрастанию цены</option>
            <option <?php if(isset($_GET['sort'])) { if($_GET['sort'] == 'popular') { echo 'selected="selected"'; } } ?> value="popular">по популярности</option>
        </select>
    </div>
</div>