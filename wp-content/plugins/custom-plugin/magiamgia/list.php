<?php
include __DIR__ . "/../includes/padding.php";
include __DIR__ . "/../includes/PHPExcel/PHPExcel.php";
include __DIR__ . "/../includes/PHPExcel/PHPExcel/Writer/Excel2007.php";
include __DIR__ . "/../includes/PHPExcel/PHPExcel/IOFactory.php";

//-------del-------------
action_list_del("tt_vouchers");
$pagesize = 20;
$s = '';
$my_str = "WHERE voucher_for_customer=0";
if (isset($_REQUEST['search'])) {
    $keyword = fixqQ($_REQUEST['keyword']);
    $special_member = (int)$_REQUEST['specialMember'];
    $s .= '&search=1';

    // Điều kiện
    $dkKey = '';
    $dkValue = '';
    //

    if (!empty($keyword)) {
        $my_str .= ' AND (ten_chuong_trinh like "%' . $keyword . '%"
        OR ma_voucher like "%' . $keyword . '%" )';
    }
    if($special_member != 2) {
        $my_str .= ' AND voucher_for_special_member = ' . $special_member;
    }
//    pr($my_str);
}

$recordcount = count_total_db("tt_vouchers", $my_str);
$paged = (int)$_GET['paged'];
if ($paged == 0) {
    $paged = 1;
}
$beginpaging = beginpaging($pagesize, $recordcount, $paged);
add_admin_css('main.css');
add_admin_js('jquery-2.2.4.min.js');
if(isset($_POST['download'])) {
    // Xuat excel
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $sheet=$objPHPExcel->getActiveSheet();
    $sheet->setCellValue('A1', 'Mã voucher');
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getColumnDimension('A')->setWidth(20);

    $current_time = time();
    $getVoucher = $wpdb->get_results("SELECT * FROM `tt_vouchers` WHERE voucher_for_customer = 1 and total_use = 0 and printed = 0");
    $rowCount   =   2;
    $check = false;
    foreach ($getVoucher as $item) {
        if(strtotime(str_replace('/', '-', $item->time_end)) > $current_time) {
            $sheet->SetCellValue('A'.$rowCount, $item->ma_voucher);
            $rowCount++;
            $check = true;
            $wpdb->update(
                'tt_vouchers',
                array('printed' => 1),
                array('id' => $item->id)
            );
        }
    }
//while($row  =   $result->fetch_assoc()){
//    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, mb_strtoupper($row['countryCode'],'UTF-8'));
//    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper($row['countryName'],'UTF-8'));
//    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper($row['capital'],'UTF-8'));
//    $rowCount++;
//}

//$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
    if($check) {
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');ob_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="danh-sach-voucher.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter->save("php://output");exit;
    }
}

?>
<style>
    .iconloadgif {
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        position: absolute;
        margin: auto;
    }

    .divgif {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 1100;
        display: none;
        background: #dedede;
        opacity: 0.5;
    }
</style>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/pl2/style.css" >
<!--<input type="hidden" id="urlAjax" value="--><?//= admin_url() ?><!--admin-ajax.php">-->
<input type="hidden" id="setting_captcha" value="<?= get_field("setting_captcha","option")["site_key"] ?>">
<input type="hidden" id="urlTheme" value="<?= get_template_directory_uri() ?>">
<div class="divgif">
    <img class="iconloadgif" src="<?= get_template_directory_uri() ?>/ajax/images/loading2.gif" alt="">
</div>
<div class="wrap">
    <h1 style="margin-bottom:15px;">Danh sách <?php echo $mdlconf['title']; ?>
        <a class="page-title-action" href="admin.php?page=discount_price&amp;sub=add">Thêm Mã giảm giá mới</a>
    </h1>
    <form method="post" action="" style="display: none">
        <input type="hidden" name="download" value="">
        <button type="submit" class="button download-voucher-btn">Tải xuống voucher</button>
    </form>
    <ul class="subsubsub">
        <li class="all"><a class="current" href="<?php echo $module_path; ?>">Tất cả <span
                        class="count">(<?php echo $recordcount; ?>)</span></a></li>
    </ul>

    <form class="search-box flr" method="POST" action="<?php echo $module_path; ?>">
        <select name="specialMember">
            <option value="2">Tất cả các loại voucher</option>
            <option value="0">Áp dụng cho mọi thành viên</option>
            <option value="1">Áp dụng cho thành viên đặc biệt</option>
        </select>
        <input class="sear_2" value="<?php if (isset($keyword)) echo $keyword; ?>" type="text" name="keyword"
               placeholder="Từ khóa">
        <input type="submit" name="search" value="Lọc" class="button"/>
    </form>
    <?php
    $myrows = $wpdb->get_results("SELECT * FROM `tt_vouchers` ". $my_str ." ORDER BY id DESC LIMIT  " . $beginpaging[0] . ",$pagesize");
    ?>

    <form class="" method="POST" action="<?php echo $module_path; ?>">
        <div class="tablenav top">
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
                <td class="manage-column column-cb check-column" id="cb">
                    <input type="checkbox" id="cb-select-all-1"></td>
                <th style="width:30px;text-align:center;">STT</th>
                <th>Tên Voucher</th>
                <th>Mã voucher</th>
                <th>Thời gian sử dụng mã</th>
                <th>Loại giảm giá</th>
                <th>Mức giảm</th>
                <th>Giá trị đơn hàng tối thiểu</th>
                <th>Tổng lượt sử dụng tối đa</th>
                <th>Lượt sử dụng tối đa/Người mua</th>
                <th>Kiểu áp dụng</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr class="headline">
                <td class="manage-column column-cb check-column" id="cb">
                    <input type="checkbox" id="cb-select-all-1"></td>
                <th style="width:30px;text-align:center;">STT</th>
                <th>Tên Voucher</th>
                <th>Mã voucher</th>
                <th>Thời gian sử dụng mã</th>
                <th>Loại giảm giá</th>
                <th>Mức giảm</th>
                <th>Giá trị đơn hàng tối thiểu</th>
                <th>Tổng lượt sử dụng tối đa</th>
                <th>Lượt sử dụng tối đa/Người mua</th>
                <th>Kiểu áp dụng</th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>

            <?php
            $i = 0;
            foreach ($myrows as $key => $item) {
                $stt = $key+1;
                $rowlink = $module_path . '&sub=edit&id=' . $item->id;
                ?>
                <tr>
                    <th class="check-column" scope="row">
                        <input type="checkbox" value="<?php echo $item->id; ?>" name="post[]"/>
                    </th>
                    <td><?= $stt ?></td>
                    <td><a href="<?= $rowlink ?>" target="blank"><?= $item->ten_chuong_trinh ?></a></td>
                    <td> <?php echo $item->ma_voucher ?></td>
                    <td><?php echo $item->time_start.' <br> '.$item->time_end ?></td>
                    <td><?= $item->loai_giam_gia==1?'Theo số tiền':'Theo phần trăm' ?> </td>
                    <td><?= $item->loai_giam_gia==1?number_format($item->muc_giam,0,',','.').'đ':$item->muc_giam_2.'%' ?></td>
                    <td><?= number_format($item->gia_tri_toi_thieu,0,',','.').'đ' ?> </td>
                    <td><?= $item->tong_luot_sd_toi_da ?> </td>
                    <td><?= $item->luot_sd_toi_da_nguoi_mua ?> </td>
                    <td><?= $item->kieu_voucher==1?'Áp dụng cho sản phẩm':'Áp dụng cho thành viên' ?> </td>
                    <td><a href="javascript:void(0)" class="remove-action" data-id="<?= $item->id ?>">Xóa</a></td>
                    <td><a href="<?= $rowlink ?>" class="detail-action" data-id="<?= $item->id ?>">Xem chi tiết</a></td>
                </tr>
            <?php } ?>
        </table>

    </form>

    <?php echo paddingpage($module_short_url, $beginpaging[1], $beginpaging[2], $beginpaging[3], $paged, $pagesize, $recordcount, $s); ?>

</div>


<?php
add_admin_js('common.js');
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= get_field("setting_captcha","option")["site_key"] ?>"></script>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/sweetalert2/dist/sweetalert2.min.css">
<script src="<?= get_template_directory_uri() ?>/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    let urlAjax = $("#urlAjax").val();
    let site_key = $("#site_key").val();
    let success_code = $("#success_code").val();
    $('.remove-action').on('click', function () {
        let voucherId = $(this).attr('data-id');

        Swal.fire({
            title: 'Xác nhận xóa voucher',
            text: "Bạn có chắc muốn xóa voucher này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                grecaptcha.ready(function () {
                    grecaptcha.execute(site_key, {action: 'delete_MGG'}).then(function (token) {
                        $.ajax({
                            url: urlAjax,
                            type: 'POST',
                            cache: false,
                            dataType: "json",
                            data: {
                                id: voucherId,
                                action: 'deleteMGG',
                                action1: "delete_MGG",
                                token1: token
                            },
                            beforeSend: function () {
                                $('.divgif').css('display', 'block');
                            },
                            success: function (rs) {
                                $('.divgif').css('display', 'none');
                                if (rs.status == success_code) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: rs.mess,
                                    });
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: rs.mess,
                                    });
                                }
                            }
                        });
                        return false;
                    });
                });
            }
        })
    });
</script>
<?php if(isset($check) && !$check): ?>
<script>
    Swal.fire({
        icon: 'error',
        text: 'Không tìm thấy mã giảm giá phù hợp để tải xuống',
    });
</script>
<?php endif; ?>