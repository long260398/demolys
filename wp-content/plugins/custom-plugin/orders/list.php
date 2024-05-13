<?php
include __DIR__ . "/../includes/padding.php";

//pr(123);

//-------del-------------
action_list_del("tt_orders");
$pagesize = 20;
$s = '';
$rs = $wpdb->get_results("SELECT id,name FROM tt_orders ");
$my_str = "WHERE 1=1";

if (isset($_REQUEST['search'])) {
    $keyword = fixqQ($_REQUEST['keyword']);
    $s .= '&search=1';
    $orderStatus = (int)$_REQUEST['orderStatus'];
    $date_b = strtotime(no_sql_injection($_REQUEST['from_date'] . ' 00:00:00'));
    $date_then = strtotime(no_sql_injection($_REQUEST['to_date'] . ' 23:59:59'));
    // Điều kiện
    $dkKey = '';
    $dkValue = '';
    //
    if ($from_date != '' && $to_date != '') {
        if ($date_b < $date_then) {
            $my_str .= " and (time_order >= " . $date_b . " and time_order <=" . $date_then . ")";
            $s .= '&from_date=' . urlencode($from_date) . '&to_date=' . urlencode($to_date);
        }
    } elseif ($to_date != '') {
        $my_str .= " and (time_order >= 0 and time_order <=" . $date_then . ")";
        $s .= '&to_date=' . urlencode($to_date);
    } elseif ($from_date != '') {
        $my_str .= " and (time_order >= " . $date_b . " and time_order <=" . time() . ")";
        $s .= '&from_date=' . urlencode($from_date);
    }
    if ($keyword != null) {
        $my_str .= ' AND order_code like "%' . $keyword . '%" OR full_name like "%' . $keyword . '%" OR email like "%' . $keyword . '%" OR phone_number like "%' . $keyword . '%" ';
    }
    if($orderStatus != -1) {
        $my_str .= ' AND status = ' . $orderStatus;
    }

}
if (isset($_POST['export'])) {
    $keyword = no_sql_injection(xss($_REQUEST['keyword']));
    $from_date = no_sql_injection($_REQUEST['from_date']);
    $to_date = no_sql_injection($_REQUEST['to_date']);
    $date_b = strtotime(no_sql_injection($_REQUEST['from_date'] . ' 00:00:00'));
    $date_then = strtotime(no_sql_injection($_REQUEST['to_date'] . ' 23:59:59'));
    $trang_thai = no_sql_injection(xss($_REQUEST['trang_thai']));
    $s .= '&search=1';
    if ($keyword != '') {
        $my_str .= " and (order_code like '%" . $keyword . "%' ";
        $my_str .= " or full_name like '%" . $keyword . "%' ";
        $my_str .= " or email like '%" . $keyword . "%' )";
        $s .= '&keyword=' . urlencode($keyword);
    }
    if ($from_date != '' && $to_date != '') {
        if ($date_b < $date_then) {
            $my_str .= " and (time_order >= " . $date_b . " and time_order <=" . $date_then . ")";
            $s .= '&from_date=' . urlencode($from_date) . '&to_date=' . urlencode($to_date);
        }
    } elseif ($to_date != '') {
        $my_str .= " and (time_order >= 0 and time_order <=" . $date_then . ")";
        $s .= '&to_date=' . urlencode($to_date);
    } elseif ($from_date != '') {
        $my_str .= " and (time_order >= " . $date_b . " and time_order <=" . time() . ")";
        $s .= '&from_date=' . urlencode($from_date);
    }
    if ($trang_thai != '') {
        $my_str .= " and status=" . $trang_thai;
        $s .= '&trang_thai=' . urlencode($trang_thai);
    }
    $sql = "SELECT * FROM tt_orders " . $my_str . " ORDER BY id DESC ";
    $rs = $wpdb->get_results($sql);
//    print_r(dirname(__FILE__) . '/excel/PHPExcel/Classes/PHPExcel.php');die();
    include(get_template_directory() . '/dist_peri/PHPExcel/PHPExcel.php');

    $objPHPExcel = new PHPExcel();

    $objPHPExcel->getProperties()->setCreator("Excel")
        ->setLastModifiedBy("Excel")
        ->setTitle("Office 2    007 XLSX Document")
        ->setSubject("Office 2007 XLSX Document")
        ->setDescription("Document for Office 2007 XLSX..")
        ->setKeywords("office 2007")
        ->setCategory("Export Excel");

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Đơn hàng Peri')
        ->setCellValue('B1', 'Tên khách hàng')
        ->setCellValue('C1', 'Số điện thoại')
        ->setCellValue('D1', 'Giá tiền')
        ->setCellValue('E1', 'Phương thức thanh toán')
        ->setCellValue('F1', 'Ngày đặt')
        ->setCellValue('G1', 'Trạng thái');
    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'font' => array('name' => 'Times New Roman', 'color' => array('rgb' => '254C12'), 'bold' => true),
    );
    $style_2 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),

    );
    $style_3 = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'font' => array('name' => 'Times New Roman', 'color' => array('rgb' => '254C12'), 'bold' => true),
    );

    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
//    $objPHPExcel->getActiveSheet()->getStyle('A2:D2')->applyFromArray($style);

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $numRow = 2;
    foreach ($rs as $row) {

        $text = '';
        $text_2 = '';
        switch ($row->payment_method) {
            case 1:
                $text = "COD(Thanh tóa khi giao hàng)";
                break;
            case 2:
                $text = "Thanh Toán Qua Internet Bankking";
                break;
            default:
                $text = "COD(Thanh tóa khi giao hàng)";
        }
        switch ($row->status) {
            case 1:
                $statusText = 'Đang thực hiện thanh toán';
                break;
            case 2:
                $statusText = 'Thanh toán thành công';
                break;
            case 3:
                $statusText = 'Hủy đơn hàng';
                break;
            default:
                $statusText = 'Đang thực hiện thanh toán';
        }
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $numRow, $row->order_code);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $numRow, $row->full_name);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $numRow, $row->phone_number);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $numRow,  money_check($row->price_payment).' VND');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $numRow,$text);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $numRow,  date('d-m-Y H:i', $row->time_order));
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $numRow,$statusText);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $numRow)->applyFromArray($style_2);
        $objPHPExcel->getActiveSheet()->getStyle('G' . $numRow)->applyFromArray($style_2);
        $numRow++;
    }
    $tong_tt = 0;
    $tong_tong = 0;

    foreach ($rs as $value) {
        $tong_tong += $value->price;
        if ($value->status == 2 || $value->status == 6) {
            $tong_tt += $value->price;
        }
    }
    $upload_dir = wp_upload_dir();

// Đường dẫn đầy đủ đến thư mục uploads
    $upload_path = $upload_dir['basedir'];

// Tạo thư mục nếu nó không tồn tại
    $export_dir = $upload_path . '/export';
    if (!file_exists($export_dir)) {
        mkdir($export_dir, 0777, true);
    }
    $numRow_1 = $numRow + 1;
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $numRow . ':F' . $numRow);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $numRow_1 . ':F' . $numRow_1);
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $numRow, 'Tổng doanh thu')
        ->setCellValue('G' . $numRow, number_format($tong_tong) . ' VND');
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $numRow_1, 'Khách hàng đã trả')
        ->setCellValue('G' . $numRow_1, number_format($tong_tt) . ' VND');
    $objPHPExcel->getActiveSheet()->getStyle('I' . $numRow)->applyFromArray($style_3);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $numRow . ':H' . $numRow)->applyFromArray($style);
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
    $objPHPExcel->getActiveSheet()->getRowDimension($numRow)->setRowHeight(25);


    $objPHPExcel->getActiveSheet()->setTitle('Thống kê Đơn hàng PERI');


    $objPHPExcel->setActiveSheetIndex(0);
    $file_save_o = 'Thống kê Đơn hàng PERI từ ' . $from_date . ' đến ' . $to_date . '.xlsx';
    $file_save = $export_dir . '/Thống kê Đơn hàng PERI từ ' . $from_date . ' đến ' . $to_date . '.xlsx';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    $objWriter->setIncludeCharts(true);

    $objWriter->save($file_save);

    $fpath = $upload_dir['baseurl'] . '/export/' . basename($file_save);
}
$recordcount = count_total_db("tt_orders", $my_str);
$paged = (int)$_GET['paged'];
if ($paged == 0) {
    $paged = 1;
}
$beginpaging = beginpaging($pagesize, $recordcount, $paged);
add_admin_css('main.css');
add_admin_js('jquery-2.2.4.min.js');

function getStatusPayment($status)
{
    $trang_thai = [
        1 => 'Đang thực hiện thanh toán',
        2 => 'Thanh toán thành công',
        3 => 'Hủy đơn hàng'

    ];
    $text = '';
    for ($i = 1; $i <= 3; $i++) {
        if (!empty($trang_thai[$i])) {
            if ($status == $i) {
                $text .= "<option selected value='" . $i . "'>" . $trang_thai[$i] . "</option>";
            } else {
                $text .= "<option value='" . $i . "'>" . $trang_thai[$i] . "</option>";
            }
        }
    }
    return $text;
}
// Lấy danh sách thành viên đặc biệt
$getListSpecial = $wpdb->get_results("SELECT * FROM useragency WHERE special_member = 1");

?>
<style>
    .flr{
        display: flex;
        float: right;
    }
    .d-none{
        display: none;
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
    <h1 style="margin-bottom:15px;">Danh sách <?php echo $mdlconf['title']; ?>
    </h1>

    <ul class="subsubsub">
        <li class="all"><a class="current" href="<?php echo $module_path; ?>">Tất cả <span
                        class="count">(<?php echo $recordcount; ?>)</span></a></li>
    </ul>
    <form class="search-box flr" method="POST" action="<?php echo $module_path; ?>">
        <span style="line-height: 24px; margin-right: 10px">Thời gian đặt hàng:  </span>
        <input class="sear_2" type="date" max="<?= date('Y-m-d') ?>"
               value="<?php if (isset($from_date)) echo $from_date; ?>" name="from_date"
               placeholder="Ngày">
        <input class="sear_2" type="date" value="<?php if (isset($to_date)) echo $to_date; ?>" name="to_date"
               placeholder="Ngày">
        <span style="line-height: 24px; margin-left: 20px; margin-right: 10px">Trạng thái đơn hàng:  </span>
        <select name="orderStatus">
            <option value="1" <?php if($orderStatus == 1) { echo 'selected'; } ?>>Đang thực hiện thanh toán</option>
            <option value="2" <?php if($orderStatus == 2) { echo 'selected'; } ?>>Thanh toán thành công</option>
            <option value="3" <?php if($orderStatus == 3) { echo 'selected'; } ?>>Hủy đơn hàng</option>
        </select>
        <input class="sear_2" value="<?php if (isset($keyword)) echo $keyword; ?>" type="text" name="keyword"
               placeholder="Từ khóa">

        <input type="submit" name="search" value="Lọc" class="button"/>
        <input type="submit" style="background: green;color: white" value="Xuất file excel" class="button action"
               name="export">
    </form>
    <?php if (isset($_POST['export'])) { ?>
        <div style="text-align: center;font-size: medium;margin-top: 55px;margin-bottom: 15px">Download file Excel
            tại
            đây
        </div>
        <a href="<?= $fpath ?>"><img style="display: block;margin: auto"
                                     src="<?= get_template_directory_uri() ?>/dist/images/dowdload_ex.jpg" alt=""></a>
        <a href="<?= $fpath ?>" style="display: block;text-align: center"><?= $file_save_o ?></a>
    <?php }  ?>
    <?php
    $myrows = $wpdb->get_results("SELECT * FROM tt_orders ". $my_str ." ORDER BY id DESC LIMIT  " . $beginpaging[0] . ",$pagesize");
    ?>
    <!--    --><?php // if ( $mess != '' ) { ?>
    <!--        <div class="notice notice-warning is-dismissible" id="message">-->
    <!--            <p>--><?php //echo $mess; ?><!--</p>-->
    <!--        </div>-->
    <!--    --><?php // } ?>

    <form class="" method="POST" action="<?php echo $module_path; ?>">

        <table class="wp-list-table widefat fixed striped posts">
            <thead>
            <tr class="headline">
                <th style="width:30px;text-align:center;">STT</th>
                <th>Mã đơn hàng</th>
                <th>Người mua</th>
                <th>Số điện thoại</th>
                <th>Ngày đặt</th>
                <th>Trạng thái đơn hàng</th>
                <th>Tổng tiền</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr class="headline">
                <th style="width:30px;text-align:center;">STT</th>
                <th>Mã đơn hàng</th>
                <th>Người mua</th>
                <th>Số điện thoại</th>
                <th>Ngày đặt</th>
                <th>Trạng thái đơn hàng</th>
                <th>Tổng tiền</th>
                <th></th>
            </tr>
            </tfoot>

            <?php
            $i = 0;
            foreach ($myrows as $order) {
                $delivery_information = json_decode($order->delivery_information);
                $i++;
                $rowlink = $module_path . '&sub=edit&id=' . $order->id;
                $rowlinkUser = 'admin.php?page=daily&sub=edit&id=' . $order->id_user;
                $rowlinkvoucher = $module_path . '&sub=voucher_info&code=' . $order->code_voucher;
                // Thanh vien dac biet
                if(!empty($order->user_refer_code)) {
                    $getUserReferCode = $wpdb->get_row("SELECT * FROM useragency WHERE refer_code='{$order->user_refer_code}'");
                    $rowlinkSpecial = 'admin.php?page=daily&sub=edit&id=' . $getUserReferCode->id;
                }
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><a href="<?php echo $rowlink; ?>" target="_blank"><?= $order->order_code ?></td>
                    <td><?= $order->full_name ?></a></td>
                    <td><?= $order->phone_number ?></td>
                  
                    <td><?= date('H:i d/m/Y', $order->time_order) ?></td>
                    <td>
                        <select style="    max-width: 10rem;" class="statusPayment" data-order-id="<?php echo $order->id; ?>">
                            <?php echo getStatusPayment($order->status); ?>
                        </select>
                    </td>
                    <td><?= number_format($order->price, 0, ',', '.') ?> <strong>đ</strong></td>
                    <td><a href="<?php echo $rowlink; ?>" target="_blank">Xem chi tiết</a></td>
                </tr>
            <?php } ?>
        </table>

    </form>

    <?php echo paddingpage($module_short_url, $beginpaging[1], $beginpaging[2], $beginpaging[3], $paged, $pagesize, $recordcount, $s); ?>

</div>

<div class="box-alert"></div>
<?php
add_admin_js('common.js');
?>
<script>
    $(document).ready(function () {
        // Thay doi trang thai thanh toan
        $('.statusPayment').on('change', function () {
            let newPayment = $(this).val();
            let orderId = $(this).attr('data-order-id');

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                cache: false,
                dataType: "text",
                data: {
                    status: newPayment,
                    orderId: orderId,
                    action: 'changePaymentStatus',
                },
                beforeSend: function() {
                    $('.divgif').css('display', 'block');
                },
                success: function(rs) {
                    $('.divgif').css('display', 'none');
                    rs = JSON.parse(rs);
                    if (rs.status == <?php echo success_code ?>) {
                        Swal.fire({
                            icon: 'success',
                            text: rs.mess,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: rs.mess,
                        });
                    }
                }
            });
        });
    });
</script>