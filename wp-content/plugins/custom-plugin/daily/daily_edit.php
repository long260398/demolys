<?php
include __DIR__ . "/../includes/padding.php";
global $wpdb;

$id = (int)($_GET['id']);
if (isset($_REQUEST['edit_action']) && (int)$_REQUEST['edit_action'] == 1) {

    // Input

    $name = $_POST['name'];
//    $phonenumber = $_POST['phonenumber'];
//    $email = $_POST['email'];

    // Kiểm tra tồn tại loại tài khoản này chưa
    $sqlCheck = "SELECT * FROM useragency where id =".$id;
    $userCheck = $wpdb->get_results($sqlCheck);

    if(empty($userCheck)){
        show_result(0, 'Tài khoản đã tồn tại');
    }else{
        if(!empty($name)) {
            $sql = "update useragency set name='$name' where id=" . $id;
            $resp = $wpdb->query($sql);
            show_result(1);
        }
    }
}

$row = $wpdb->get_row("SELECT * FROM   useragency  where id=" . $id);

?>
<style>
    input {
        width: 100%;
    }
    .d-none{
        display: none;
    }
</style>
<style>
    .roles-report{

    }
    .roles-report .item-role .table__wrapper{
        padding-bottom: 10px;
    }
    .roles-report .item-role{
        padding-bottom: 10px;
        border-bottom: 1px solid #ccc;
        padding-top: 10px;
    }

    .role-title-1{
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .role-title-2{
        font-size: 16px;
        padding-bottom: 10px;
        font-weight: 600;
    }
    .br-checkbox{
        padding-bottom: 10px;
    }
    .br-checkbox label{
        font-weight: 500;
    }
    .br-checkbox input{
        margin: 0;
    }
    .checkbox-all{
        padding-left: 15px;
    }
</style>
<div class="wrap">
    <h1>
        <?php show_admin_box_edit_title($mdlconf, $module_path); ?>
    </h1>
    <form id="adddaily" method="post" action="<?php echo $module_path . '&sub=edit&edit_action=1&id=' . $id; ?>"
          name="post">
        <div id="poststuff">
            <input type="hidden" value="<?php echo $id; ?>" name="id"/>
            <div class="metabox-holder columns-2" id="post-body">
                <!---left-->
                <div id="post-body-content" class="pos1">
                    <div class="postbox">
                        <h2 class="hndle ui-sortable-handle api-title">Thông tin</h2>
                        <div class="inside">
                            <!--                            <input type="hidden" value="-->
                            <?php //echo $id; ?><!--" name="id"/>-->
                            <table class="form-table ft_metabox leftform">
                                <?php
                                show_list_row('Họ và Tên', array('name', $row->name, 'text'));
                                show_list_row('Số điện thoại', array('phonenumber', $row->phonenumber, 'text', 'readonly'));
                                show_list_row('Email', array('	email', $row->email, 'text', 'readonly'));
                                ?>
                            </table>
                        </div>

                    </div>

                    <?php
                    if (1 == 2) {
                        $wp_editor_setting = array('wpautop' => false);
                        $content = $row->content;
                        $idname = 'content';
                        wp_editor($content, $idname, $wp_editor_setting);
                    }
                    ?>
                </div>


                <!--right-->
                <div class="postbox-container" id="postbox-container-1">
                    <div class="meta-box-sortables ui-sortable" id="side-sortables">

                        <?php
                        show_admin_btn_save($row->active);

                        //---anh-----
                        //show_admin_featured_image($row->image);
                        ?>


                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<?php
//add_admin_js('image.upload.js');

add_admin_js('jquery.min.js');
add_admin_js('jquery.validate.min.js');
?>

<script>
    $(document).ready(function () {
        $("#adddaily").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                // phonenumber: {
                //     required: true,
                //     minlength: 10,
                //     maxlength: 11,
                //     number: true
                // },
                // address: {
                //     required: true,
                //     minlength: 3,
                // },
            },
            messages: {
                name: {
                    required: "Vui lòng nhập họ tên",
                    minlength: "Tối thiểu 3 ký tự",
                },
                // address: {
                //     required: "Vui lòng nhập địa chỉ",
                //     minlength: "Tối thiểu 3 ký tự",
                // },
                // phonenumber: {
                //     required: "Vui lòng nhập số điện thoại",
                //     number: "Số điện thoại không đúng định dạng",
                //     minlength: "Số điện thoại không đúng định dạng",
                //     maxlength: "Số điện thoại không đúng định dạng",
                // },

            }
        });
    });
</script>
