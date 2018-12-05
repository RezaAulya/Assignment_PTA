<!-- 
@TODO  
-->
<?php // PARSING 
    ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Tambah Pertanyaan";
?>

<!-- TITLE -->
<title>
    <?=$form_name?>
</title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link rel="stylesheet" href="<?= $base_url .'assets/BACKEND/datepicker/datepicker.css '?>">
<link rel="stylesheet" href="<?= $base_url .'assets/BACKEND/editor/jquery-te-1.4.0.css'?>">
<script type="text/javascript" src="<?= $base_url .'assets/BACKEND/editor/jquery-te-1.4.0.min.js'?>"></script>
<script type="text/javascript" src="<?= $base_url .'assets/BACKEND/datepicker/datepicker.js'?>"></script>
<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

  //  USER ROLE
  include 'includes/role.php';
  
?>

<aside class="right-side">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- box-header -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa icon-teacher"></i>
                            <?=$form_name?>
                        </h3>


                        <ol class="breadcrumb">
                            <li>
                                <a href="<?= $base_url . 'dashboard' ?>">
                                    <i class="fa fa-laptop"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?= $base_url . 'quiz/bank' ?>">Gudang Quiz</a>
                            </li>
                            <li class="active">
                                <?= $form_name?>
                            </li>
                        </ol>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal" role="form" method="post" id="question_bank" enctype="multipart/form-data">
                                    <div class='form-group'>
                                        <label for="group" class="col-sm-2 control-label">
                                            Kategori Quiz
                                            <span class='text-red'>*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <select name="guargianID" id='guargianID' class='form-control guargianID select2'>
                                                    <option value="0">---</option>
                                                    <!-- Looping Here -->
                                                </select>
                                                <span class="input-group-addon btn btn-danger">
                                                    <a href="<?= $base_url . 'quiz/kategori-add' ?>">
                                                        <i class="fa fa-plus"></i>
                                                        Tambah Cepat Kategori </a>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>
                                    

                                    <div class='form-group'>
                                        <label for="question" class="col-sm-2 control-label">
                                            Pertanyaan
                                            <span class='text-red'>*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" id="question" name="question"></textarea>
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>
                                    

                                    <div class='form-group'>
                                        <label for="type" class="col-sm-2 control-label">
                                            Tipe Pertanyaan
                                            <span class='text-red'>*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <select name="type" id='type' class='form-control select2'>
                                                <option value="0">---</option>
                                                <option value="1">Pilihan Ganda</option>
                                            </select>
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class='form-group' id='totalOptionDiv'>
                                        <label for="totalOption" class="col-sm-2 control-label">
                                            Total Pilihan </label>
                                        <div class="col-sm-6">
                                            <select name="totalOption" id='totalOption' class='form-control select2'>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div id="in"></div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-6">
                                            <input type="submit" class="btn btn-success btn-block margin-bottom" value="Simpan Pertanyaan">
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        <!-- col-sm-12 -->
                    </div>
                    <!-- row -->
                </div>
                <script type="text/javascript">
                    $(document).on('click', '#close-preview', function(){
                        $('.image-preview').popover('hide');
                        // Hover befor close the preview
                        $('.image-preview').hover(
                            function () {
                               $('.image-preview').popover('show');
                               $('.content').css('padding-bottom', '100px');
                            },
                             function () {
                               $('.image-preview').popover('hide');
                               $('.content').css('padding-bottom', '20px');
                            }
                        );
                    });
                
                    $(function() {
                        // Create the close button
                        var closebtn = $('<button/>', {
                            type:"button",
                            text: 'x',
                            id: 'close-preview',
                            style: 'font-size: initial;',
                        });
                        closebtn.attr("class","close pull-right");
                        // Set the popover default content
                        $('.image-preview').popover({
                            trigger:'manual',
                            html:true,
                            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                            content: "There's no image",
                            placement:'bottom'
                        });
                        // Clear event
                        $('.image-preview-clear').click(function(){
                            $('.image-preview').attr("data-content","").popover('hide');
                            $('.image-preview-filename').val("");
                            $('.image-preview-clear').hide();
                            $('.image-preview-input input:file').val("");
                            $(".image-preview-input-title").text("File Browse");
                        });
                        // Create the preview image
                        $(".image-preview-input input:file").change(function (){
                            var img = $('<img/>', {
                                id: 'dynamic',
                                width:250,
                                height:200,
                                overflow:'hidden'
                            });
                            var file = this.files[0];
                            var reader = new FileReader();
                            // Set preview image into the popover data-content
                            reader.onload = function (e) {
                                $(".image-preview-input-title").text("File Browse");
                                $(".image-preview-clear").show();
                                $(".image-preview-filename").val(file.name);
                                img.attr('src', e.target.result);
                                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                                $('.content').css('padding-bottom', '100px');
                            }
                            reader.readAsDataURL(file);
                        });
                    });
                
                    $('#question').jqte();
                    $('#explanation').jqte();
                    $(function () {
                        $('#totalOptionDiv').hide();
                    });
                
                    $(document).ready(function() {
                        var totalOptionID = '0';
                        if(totalOptionID > 0) {
                            $('#totalOptionDiv').show();
                        }
                    });
                
                    $('#type').change(function() {
                        $('#in').children().remove();
                        var type = $(this).val();
                        if(type == 0) {
                            $('#totalOptionDiv').hide();
                        } else {
                            $('#totalOption').val(0);
                            $('#totalOptionDiv').show();
                        }
                
                    });
                
                    $('#totalOption').change(function() {
                        var valTotalOption = $(this).val();
                        var type = $('#type').val();
                
                        if(parseInt(valTotalOption) !=0) {
                            var opt = [];
                            var ans = [];
                            var count = $('.coption').size();
                
                            for(j=1; j<=count; j++) {
                                if(type == 3) {
                                    opt[j] = $('#answer'+j).val();
                                } else {
                                    opt[j] = $('#option'+j).val();
                                    if($('#ans'+j).prop('checked')) {
                                        ans[j] = 'checked="checked"';
                                    }
                                }
                            }
                                        
                            $('#in').children().remove();
                            for(i=1; i<=valTotalOption; i++) {
                                if($('#in').size())
                                    $('#in').append(formHtmlData(i, type, opt[i], ans[i]));
                                else
                                    $('#in').append(formHtmlData(i, type));
                            }   
                
                        } else {
                             $('#in').children().remove();
                        }
                
                    });
                
                    function formHtmlData(id, type, value='', checked='') {
                        var required = 'required';
                        if(type == 1) {
                            type = 'radio';
                        }
                        var html = '<div class="form-group coption"><label for="option'+id+'" class="col-sm-2 control-label">Pilihan '+ id +'</label><div class="col-sm-4" style="display:inline-table"><input type="text" class="form-control" id="option'+id+'" name="option[]" value="'+value+'" placeholder="Pilihan '+id+'" ><span class="input-group-addon"><input class="answer" id="ans'+id+'" '+checked+' type="'+type+'" name="answer[]" value="'+id+'" data-toggle="tooltip" data-placement="top" title="Correct Answer" '+ required +' /></span></div><div class="col-sm-3" style="display:inline-table"></div><span class="col-sm-3 control-label text-red" id="anserror'+id+'"></span></div>';
                        return html;
                    }   
                </script>
                <!-- Body -->
            </div>
            <!-- /.box -->

        </div>
        </div>
    </section>
</aside>



<?php 
    include 'includes/page_footer.php';
?>