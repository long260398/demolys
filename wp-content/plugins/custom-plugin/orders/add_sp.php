<?php
global $wpdb;
require_once __DIR__ . '/../includes/function.php';
//require_once __DIR__ . '/../includes/inc/pagination.php';
//$myrows = $wpdb->get_results( "SELECT * FROM ".$wpdb->pre fix."useragency" );
//$module_path = 'admin.php?page=daily';
$module_pathadd = 'admin.php?page=add_guarantee';
$module_short_url = str_replace('admin.php?page=', '', $module_pathadd);
$mess = '';
$mdlconf = array('title' => 'Sản phẩm');
include __DIR__ . "/../includes/padding.php";


wp_enqueue_script('jquery');// jQuery
add_admin_css('main.css');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$datetime = time();


//$query_post = new WP_Query($args);
//$posts = $query_post->posts;
?>
<link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/themes/theme/dist/bottstrap/css/bootstrap.min.css">
<style>
    input {
        width: 100%;
    }

    .d-none {
        display: none !important;
    }

    .roles-report .item-role .table__wrapper {
        padding-bottom: 10px;
    }

    .roles-report .item-role {
        padding-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-top: 10px;
    }

    .role-title-1 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .role-title-2 {
        font-size: 16px;
        padding-bottom: 10px;
        font-weight: 600;
    }

    .br-checkbox {
        padding-bottom: 10px;
    }

    .br-checkbox label {
        font-weight: 500;
    }

    .br-checkbox input {
        margin: 0;
    }

    .checkbox-all {
        padding-left: 15px;
    }

    .title-mgg {
        font-weight: 500 !important;
        padding: 0 !important;
    }

    .red-validate {
        color: red;
    }

    .date-time {
        display: flex;
        flex-wrap: wrap;
    }

    .time-space {
        padding-left: 10px;
        padding-right: 10px;
        font-size: 20px;
    }

    .date-time input {

    }

    .date-time .time-start {

    }

    .date-time .time-end {

    }

    .loaigiamgia {
        display: flex;
        flex-wrap: wrap;
    }

    .loaigiamgia .type-gg {

    }

    #adddform {

    }

    input[type=number] {
        -webkit-appearance: none !important; /* loại bỏ giao diện mặc định */
        appearance: none !important;
    }

    .mucgiamtd .type-mgtd {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        padding-bottom: 15px;
    }

    .mucgiamtd .type-mgtd .typetd {
        padding-right: 30px;
    }

    .inputnumber {
        width: 400px !important;
    }

    .button-change {
        width: max-content;
        color: red;
        border-radius: 5px;
        border: 1px solid red;
        cursor: pointer;
    }

    .border-error {
        border: 1px solid #e91c24 !important;
    }

    .checkboxmg {
        margin: 0;
    }

    .modal-address {
        display: none;
        position: fixed;
        width: 960px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #ffffff;
        border-radius: 5px;
        z-index: 1001;
        padding: 10px 15px;
    }

    .bg__overlay {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(41, 43, 46, 0.5);
        z-index: 1000;
        top: 0;
    }

    .active_delivery .bg__overlay {
        display: block !important;
    }

    .active_delivery .modal-address {
        display: block !important;
    }

    .d-block {
        display: block !important;
    }

    .ffchoice-button {
        color: #333;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        position: relative;
        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: 32px;
        min-width: 72px;
        padding: 0 16px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 4px;
        outline: none;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .footer-pup {
        padding-top: 30px;
        padding-bottom: 10px;
        text-align: right;
    }

    .ffchoice-button--primary {
        color: #fff;
        background-color: #ee4d2d;
        border-color: #ee4d2d;
    }

    .popup__content .title h2 {
        font-size: 25px;
    }

    .chang-form {
        height: 500px;
        overflow: auto;
    }

    .chang-form tbody tr {

    }

    .chang-form tbody tr td {
        vertical-align: middle;
    }

    .title-san_pham {
        display: flex;
    }

    .title-san_pham .i-m-g img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .title-san_pham .info-san_pham {
        padding-left: 5px;
    }

    .title-san_pham .info-san_pham p {
        margin: 0;
    }

    .ffchoice-button--applyallpro {
        margin-bottom: 10px;
    }

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

    .pagnition {
        text-align: center;
        padding-top: 40px;
    }
    .pagnition .page-numbers {
        padding: 8px 12px !important;
        background: #ffffff;
        color: #000;
        font-size: 18px;
        font-family: OpenSans-Bold, sans-serif; }
    .pagnition .page-numbers:hover {
        background-color: #ee4d2d;
        color: #fff; }
    .pagnition span {
        margin-left: 0 !important; }
    .pagnition .prev i {
        font-size: 12px;
        padding: 3px 3px; }
    .pagnition .next i {
        font-size: 12px;
        padding: 3px 3px; }
    .pagnition .current {
        background-color: #ee4d2d;
        color: #fff; }

    .ov-hiden{
        overflow: hidden;
    }

    .member-search {
        display: flex;
    }
    .member-search .button.button-primary {
        width: 100px;
    }
    #memberSearch {
        width: 500px;
        margin-bottom: 10px;
    }
</style>
<div class="divgif">
    <img class="iconloadgif" src="<?= get_template_directory_uri() ?>/ajax/images/loading2.gif" alt="">
</div>
<div class="wrap">
    <input type="hidden" id="urlAjax" value="<?= admin_url() ?>admin-ajax.php">
    <!--    <input type="hidden" id="site_key" value="--><?//= get_field("setting_captcha", "option")["site_key"] ?><!--">-->
    <h1>
        <?php show_admin_box_add_title($mdlconf); ?>
    </h1>
    <div class="result">

    </div>
</div>

<div class="popup_delivery_information">
<!--    <div class="filemau mt-3">-->
<!--        <div class="d-flex align-items-center" style=" gap: 20px">-->
<!--            <div>-->
<!--                <h4 class="hndle ui-sortable-handle api-title" style="text-transform: uppercase">file excel Mẫu</h4>-->
<!--                <p style="font-size: 16px">Hãy sử dụng bản excel trước khi upload</p>-->
<!--            </div>-->
<!--            <a class="btn btn-outline-secondary" style="height: fit-content;" href="--><?php //echo site_url(); ?><!--/wp-content/plugins/WG-Wecan/includes/file_demo_BH.xlsx" download>Tải xuống</a>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
    <!--    <form action="" method="post" enctype="multipart/form-data" id="upload-excel">-->
    <!--        <label for="" style="font-size: 16px; font-weight: 700;">Chọn file excel để upload</label><br><br>-->
    <!--        <input type="submit" name="uploadBtn" class="button" value="Upload">-->
    <!--    </form>-->
    <form id="upload-excel" method="post" enctype="multipart/form-data"  name="post">
        <div id="poststuff">
            <div class="metabox-holder columns-2" id="post-body">

                <!---left-->
                <div id="post-body-content" class="pos1">
                    <div class="postbox">
                        <h2 class="hndle ui-sortable-handle api-title">Thông tin</h2>
                        <div class="inside">
                            <!--                            <input type="hidden" value="-->
                            <?php //echo $id; ?><!--" name="id"/>-->
                            <table class="form-table ft_metabox leftform">

                                <tr>
                                    <td>
                                        <label for="loaitaikhoan">File excel sản phẩm <span style="color: red">*</span></label>
                                    </td>
                                    <td>
                                        <div class="item-detail-3">


                                            <input type="file" class="file-upload form-control" name="file-upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <!--right-->
                <div class="postbox-container" id="postbox-container-1">
                    <div class="meta-box-sortables ui-sortable" id="side-sortables">

                        <div class="postbox " id="submitdiv">
                            <h2 class="hndle ui-sortable-handle"><span>Cập nhật</span></h2>
                            <div class="inside">
                                <div id="submitpost" class="submitbox">
                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <input type="submit" name="uploadBtn" id="publish" class="button button-primary button-large" value="Cập nhật">

                                            <!--                                            <input type="submit" value="Cập nhật" id="publish"-->
                                            <!--                                                   class="button button-primary button-large" name="save">-->
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<link rel="stylesheet" href="<?= plugin_path ?>/assets/cds_datepicker/css/jquery-ui.css">
<link rel="stylesheet" href="<?= plugin_path ?>/assets/cds_datepicker/css/jquery-ui-timepicker-addon.css">
<link rel="stylesheet" href="<?= plugin_path ?>/assets/cds_datepicker/fontawesome/css/all.min.css">

<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script src="<?= plugin_path ?>/assets/cds_datepicker/js/jquery-1.11.1.min.js"></script>
<script src="<?= plugin_path ?>/assets/cds_datepicker/js/jquery-ui.min.js"></script>
<script src="<?= plugin_path ?>/assets/cds_datepicker/js/jquery-ui-timepicker-addon.js"></script>
<script src="<?= get_template_directory_uri() ?>/ajax/js/main-ajax.js"></script>
<?php
//add_admin_js('image.upload.js');
//add_admin_js('jquery.min.js');
add_admin_js('jquery.validate.min.js');
?>

<div class="divgif">
    <img class="iconloadgif" src="<?= get_template_directory_uri() ?>/ajax/images/loading2.gif" alt="">
</div>

<script>
    function closeBtn() {
        var closeBtns = document.querySelectorAll('.close-btn');
        closeBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                var item = btn.parentNode;
                item.style.display = 'none';
            });
        });
    }
    $('#dropdownYear').each(function() {

        var year = (new Date()).getFullYear();
        var current = year;
        year -= 3;
        for (var i = -2; i < 10; i++) {
            if ((year+i) == current)
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
        }

    });


    $('#upload-excel').submit(function(e) {
        e.preventDefault();
        var file_data = $('.file-upload').prop('files')[0];
        var form_data = new FormData();

        form_data.append('file', file_data);
        form_data.append('action', 'uploadExcel');
        if(file_data === undefined) {
            alert('Chưa có file nào được chọn!');
        } else {
            $.ajax({
                type: 'post',
                dataType: 'text',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend:function () {
                    $('.divgif').show();
                },
                success: function(response) {
                    $('.divgif').hide();
                    $('.result').html(response);
                    closeBtn();
                }
            });
        }
    });
</script>





