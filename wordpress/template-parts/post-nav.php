<?php
$current = 1;
$count = $args['count'];
$post_count = $args['max_page'];
$max_page = ceil(($post_count / $count));
if(isset($_GET['page'])) {
    $current = $_GET['page'];
}
$url = '?';
foreach($_GET as $key => $item) {
    if($key != 'page') {
        $url .= $key.'='.$item.'&';
    }
}
if($max_page > 1) {
    ?>
    <ul class="page-nav">
        <?php
        for($i = 1; $i <= $max_page; $i++) {
            ?>
            <li <?php if($i == $current) { echo 'class="current-page"'; } ?>>
                <a href="<?php echo $url.'page='.$i; ?>"><?php echo $i; ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
}
