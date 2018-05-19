<div class="row">
    <div class="col-xs-12">
        <div class="sh_title_manager_product" style="margin-bottom: 40px; display: block">
            <h2>Thiết lập điều khoản</h2>
        </div>
        <div class="sh_content_alert">
            <?php if(isset($_SESSION['delete_success'])){?>
            <div class="alert alert-success">
                <strong>Xóa thành công!</strong>
            </div>
            <?php }
                unset($_SESSION['delete_success'])
            ?>
        </div>
    </div>
    <?php 
        if(isset($_POST['sh_form_submit_prd'])){
            $file = fopen("././public/cdn/policy.php",'w');
            $content = htmlspecialchars(isset($_POST['sh_form_content_prd']) ? $_POST['sh_form_content_prd'] : "",  ENT_QUOTES);
            $recontent = htmlspecialchars_decode($content);
            fwrite($file,$recontent);
            fclose($file);
        }
    ?>
    <div class="col-xs-12 sh_btn_confirm_save">
        <form method="post">
            <textarea name="sh_form_content_prd" id="sh_form_content_prd" style="display: none"></textarea>
            <button type="submit" name="sh_form_submit_prd" id="sh_form_submit_prd">Lưu lại</button>
        </form>
    </div>
    <div class="col-xs-12 space_left_right" style="margin-top: 20px">
        <div class="col-xs-12">
            <div class="sh_sonH_editor">
                <div class="sh_toolbar_editor">
                    <a href="#" data-command='p'>P</a>
                    <a href="#" data-command='h1'>H1</a>
                    <a href="#" data-command='h2'>H2</a>
                    <a href="#" data-command='bold'><i class='fa fa-bold'></i></a>
                    <a href="#" data-command='italic'><i class='fa fa-italic'></i></a>
                    <a href="#" data-command='underline'><i class='fa fa-underline'></i></a>
                    <a href="#" data-command='justifyLeft'><i class='fa fa-align-left'></i></a>
                    <a href="#" data-command='justifyCenter'><i class='fa fa-align-center'></i></a>
                    <a href="#" data-command='justifyRight'><i class='fa fa-align-right'></i></a>
                    <a href="#" data-command='justifyFull'><i class='fa fa-align-justify'></i></a>
                    <a href="#" data-command='insertUnorderedList'><i class='fa fa-list-ul'></i></a>
                    <a href="#" data-command='insertOrderedList'><i class='fa fa-list-ol'></i></a>
                    <a href="#" data-command='createlink'><i class='fa fa-link'></i></a>
                    <a href="#" data-command='unlink'><i class='fa fa-unlink'></i></a>
                    <a href="#" data-command='insertimage'><i class='fa fa-image'></i></a>
                </div>
                <div id='sh_content_editor' contenteditable>
                    <?php
                        $file = fopen("././public/cdn/policy.php",'r');
                        while(!feof($file))
                        {
                            echo fgets($file);
                        }
                        fclose($file);
                    ?>
                </div>
            </div>
            <div class="col-xs-12 sh_content_file_policy">
                    <?php 
                        require_once("././public/cdn/policy.php");
                    ?>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<script>
    $('.sh_toolbar_editor a').click(function(e) {
        e.preventDefault()
        var command = $(this).data('command')
        if (command == 'h1' || command == 'h2' || command == 'p') {
            document.execCommand('formatBlock', false, command);
        }
        if (command == 'createlink' || command == 'insertimage') {
            e.preventDefault()
            url = prompt('Enter the link here: ', 'http:\/\/');
            document.execCommand($(this).data('command'), false, url);
        } else document.execCommand($(this).data('command'), false, "");
    })

    $("#sh_content_editor").keyup(function(e) {
        $("#sh_form_content_prd").val($("#sh_content_editor").html())
    })
</script>