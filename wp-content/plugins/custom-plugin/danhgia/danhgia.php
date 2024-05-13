<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/21/2023
 * Time: 2:52 PM
 */
global $wpdb;
$module_path = 'admin.php?page=reviews';
$page = 'reviews';
$my_str = "WHERE 1=1";
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
//    echo $keyword;die;
    //
    if ($keyword != '') {
        $my_str .= ' AND ffc_posts.post_title like "%' . $keyword . '%" OR reviews.comment LIKE "%' . $keyword . '%"';

    }
}
if(isset($_POST['status'])) {
    $status = (int)$_POST['status'];
    if($status == 1 || $status == 0) {
        $my_str .= ' AND reviews.status = ' . $status;
    }
}

/*Max Number of results to show*/
$max = 20;
/*Get the current page eg index.php?pg=4*/

if(isset($_GET['pg'])){
    $p = (int) $_GET['pg'];
}else{
    $p = 1;
}
$limit = ($p - 1) * $max;
$prev = $p - 1;
$next = $p + 1;
$limits = (int)($p - 1) * $max;
// get comment with status = 1
$getComment = $wpdb->get_results("SELECT * FROM reviews JOIN ffc_posts ON reviews.product_id = ffc_posts.ID {$my_str} ORDER BY reviews.id DESC LIMIT {$limits}, {$max}", OBJECT);
$getCommentTotal = $wpdb->get_results("SELECT * FROM reviews", OBJECT);
$totalres = count($getCommentTotal);
//devide it with the max value & round it up
$totalposts = ceil($totalres / $max);
$lpm1 = $totalposts - 1;


?>
<style>
    .pagination {
        float: right;
    }
    .pagination a,
    .pagination span {
        display: inline-block;
        vertical-align: baseline;
        min-width: 30px;
        min-height: 30px;
        margin: 0;
        padding: 0 4px;
        font-size: 16px;
        line-height: 1.625;
        text-align: center;
    }
    .divgif {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 1100;
        display: none;
        background: #dedede;
        opacity: 0.5;
        top: 0;
        left: 0;
    }
    .iconloadgif {
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        position: absolute;
        margin: auto;
        width: 150px;
        height: 150px;
    }
</style>
<div class="divgif">
    <img class="iconloadgif" src="<?php echo get_template_directory_uri(); ?>/ajax/images/loading2.gif" alt="">
</div>
<div class="wrap">
    <h1 style="margin-bottom:15px;">
        Quản lý đánh giá của khách hàng
    </h1>

    <ul class="subsubsub">
        <li class="all"><a class="current" href="<?php echo $module_path; ?>">Tất cả <span
                    class="count">(<?php echo $totalres; ?>)</span></a></li>
    </ul>
    <form class="search-box flr" method="POST" action="" style="float: right">
        Trạng thái:
        <select name="status" style="margin-bottom: 4px">
            <option value="2" <?php if(isset($status) && $status == 2){ echo 'selected'; } ?>>Tất cả trạng thái</option>
            <option value="1" <?php if(isset($status) && $status == 1){ echo 'selected'; } ?>>Đã duyệt</option>
            <option value="0" <?php if(isset($status) && $status == 0){ echo 'selected'; } ?>>Chưa duyệt</option>
        </select>
        <input class="sear_2" value="<?php if (isset($keyword)) echo $keyword; ?>" type="text" name="keyword"
               placeholder="Từ khóa">

        <input type="submit" name="search" value="Lọc" class="button"/>
    </form>

            <div style="display: none" class="notice updated is-dismissible" id="message">
                <p class="notice-mess"></p>
            </div>

    <form class="" method="POST" action="<?php echo $module_path; ?>">
        <div class="tablenav top" style="display: none">
            <div class="alignleft actions bulkactions">
                <select id="bulk-action-selector-top" name="action">
                    <option value="-1">Tác vụ</option>
                    <option value="1">Xóa</option>
                </select>

                <input type="submit" value="Áp dụng" class="button action" id="doaction" name="doaction">
            </div>
        </div>

        <table class="wp-list-table widefat fixed striped posts">
            <thead>
            <tr class="headline">
                <th style="width:30px;text-align:center;">STT</th>
                <!--                <th>Tài khoản</th>-->
                <th>Người đánh giá</th>
                <th>Sản phẩm đánh giá</th>
                <th>Đánh giá</th>
                <th>Số sao</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr class="headline">
                <th style="width:30px;text-align:center;">STT</th>
                <!--                <th>Tài khoản</th>-->
                <th>Người đánh giá</th>
                <th>Sản phẩm đánh giá</th>
                <th>Đánh giá</th>
                <th>Số sao</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th></th>
            </tr>
            </tfoot>

            <?php
            $i = 0;
            foreach ($getComment as $item) {
                $i++;
                $user = $wpdb->get_row("select * from useragency where id = '".$item->user_id."'");
                ?>
                <tr>
                    <td><?php echo $i; //get_list_order($max, $p, $i); ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><a href="<?php echo get_the_permalink($item->product_id); ?>" target="_blank"><?= get_the_title($item->product_id); ?></a> </td>
                    <td><?= $item->comment ?> </td>
                    <td><?php echo $item->star_rating ?> sao</td>
                    <td>
                        <select class="reviews-status" data-reviews-id="<?php echo $item->id; ?>">
                            <?php if($item->status == 1): ?>
                                <option value="1" selected>Đã duyệt</option>
                                <option value="0">Chưa duyệt</option>
                            <?php else: ?>
                                <option value="0" selected>Chưa duyệt</option>
                                <option value="1">Đã duyệt</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><?= $item->created_at ?> </td>
                    <td><a style="cursor: pointer" class="reviews-delete" data-id="<?php echo $item->id; ?>">Xóa</a></td>
                </tr>
            <?php } ?>
        </table>

    </form>

    <div class="pagination"><?php echo paginate_admin($totalposts, $p, $lpm1, $prev, $next, $page); ?></div>

</div>

<div class="box-alert"></div>
<script src="<?php echo plugin_dir_url(__DIR__) . '/assets/js/jquery.min.js'; ?>"></script>
<script>
    $('.reviews-delete').on('click', function () {
        if(confirm('Bạn có chắc chắn muốn xóa bình luận này không?')) {
            let id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                cache: false,
                dataType: "text",
                data: {
                    reviewsId: id,
                    action: 'reviewsDelete',
                },
                beforeSend: function () {

                },
                success: function (rs) {
                    rs = JSON.parse(rs);
                    if(rs.status == <?php echo error_code; ?>) {
                        alert(rs.mess);
                    } else if(rs.status == <?php echo success_code; ?>) {
                        alert(rs.mess);
                        window.location.reload();
                    }
                }
            });
        }
    });
    $('.reviews-status').on('change', function () {
        let status = $(this).val();
        let reviewId = $(this).attr('data-reviews-id');console.log(status);

        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            cache: false,
            dataType: "text",
            data: {
                reviewId: reviewId,
                status: status,
                action: 'reviewsChangeStatus',
            },
            beforeSend: function () {
                $('.divgif').show();
            },
            success: function (rs) {
                $('.divgif').hide();
                rs = JSON.parse(rs);
                if(rs.status == <?php echo error_code; ?>) {
                    alert(rs.mess);
                } else if(rs.status == <?php echo success_code; ?>) {
                    alert(rs.mess);
                }
            }
        });
    });
</script>
