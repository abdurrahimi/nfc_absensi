<!-- basic scripts -->

<!--[if !IE]> -->


<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo base_url('assets')?>/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement)
        document.write("<script src='<?php echo base_url('assets')?>/js/jquery.mobile.custom.js'>" + "<" + "/script>");
</script>
<script src="<?php echo base_url('assets')?>/js/bootstrap.js"></script>
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>

<!-- page specific plugin scripts -->
<!-- page specific plugin scripts -->
<script src="<?php echo base_url('assets')?>/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets')?>/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url('assets')?>/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url('assets')?>/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

<!--[if lte IE 8]>
  <script src="<?php echo base_url('assets')?>/js/excanvas.js"></script>
<![endif]-->
<script src="<?php echo base_url('assets')?>/js/jquery-ui.custom.js"></script>
<script src="<?php echo base_url('assets')?>/js/jquery.ui.touch-punch.js"></script>
<script src="<?php echo base_url('assets')?>/js/chosen.jquery.js"></script>
<script src="<?php echo base_url('assets')?>/js/fuelux/fuelux.spinner.js"></script>
<script src="<?php echo base_url('assets')?>/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets')?>/js/date-time/bootstrap-timepicker.js"></script>
<script src="<?php echo base_url('assets')?>/js/date-time/moment.js"></script>
<script src="<?php echo base_url('assets')?>/js/date-time/daterangepicker.js"></script>
<script src="<?php echo base_url('assets')?>/js/date-time/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url('assets')?>/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url('assets')?>/js/jquery.knob.js"></script>
<script src="<?php echo base_url('assets')?>/js/jquery.autosize.js"></script>
<script src="<?php echo base_url('assets')?>/js/jquery.inputlimiter.1.3.1.js"></script>
<script src="<?php echo base_url('assets')?>/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url('assets')?>/js/bootstrap-tag.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url('assets')?>/js/ace/elements.scroller.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.colorpicker.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.fileinput.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.typeahead.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.wysiwyg.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.spinner.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.treeview.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.wizard.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.aside.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.ajax-content.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.touch-drag.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.sidebar.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.sidebar-scroll-1.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.submenu-hover.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.widget-box.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.settings.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.settings-rtl.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.settings-skin.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.widget-on-reload.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.searchbox-autocomplete.js"></script>
<script src="<?php echo base_url('assets')?>/js/autoNumeric.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
	$(".nominal").autoNumeric("init");
    $(window).load(function () {
        $('.ace-nav > li.grey').addClass('dark');
        var i = 0;
        $('.sidebar-shortcuts')
                .find('.btn').each(function () {
            $(this).attr('class', 'btn ' + skin0_buttons[i++ % 4]);
        })

        $('.sidebar[data-sidebar-scroll=true]').ace_sidebar_scroll('updateStyle', 'scroll-white no-track');
        $('.sidebar[data-sidebar-hover=true]').ace_sidebar_hover('updateStyle', 'no-track scroll-thin scroll-white');


    });

    jQuery(function ($) {
		
        var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    responsive: true
                });
		
		var oTable3 =
                $('#dynamic-table2')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    responsive: true
                });		
				
        $('#id-disable-check').on('click', function () {
            var inp = $('#form-input-readonly').get(0);
            if (inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly', 'true');
                inp.removeAttribute('disabled');
                inp.value = "This text field is readonly!";
            }
            else {
                inp.setAttribute('disabled', 'disabled');
                inp.removeAttribute('readonly');
                inp.value = "This text field is disabled!";
            }
        });


        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});
            //resize the chosen on window resize

            $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function () {
                        $('.chosen-select').each(function () {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed')
                    return;
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });


            $('#chosen-multiple-style .btn').on('click', function (e) {
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if (which == 2)
                    $('#form-field-select-4').addClass('tag-input-style');
                else
                    $('#form-field-select-4').removeClass('tag-input-style');
            });
        }


        $('[data-rel=tooltip]').tooltip({container: 'body'});
        $('[data-rel=popover]').popover({container: 'body'});

        $('textarea[class*=autosize]').autosize({append: "\n"});
        $('textarea.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });

        $.mask.definitions['~'] = '[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999", {placeholder: " ", completed: function () {
                alert("You typed the following: " + this.val());
            }});



        $("#input-size-slider").css('width', '200px').slider({
            value: 1,
            range: "min",
            min: 1,
            max: 8,
            step: 1,
            slide: function (event, ui) {
                var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                var val = parseInt(ui.value);
                $('#form-field-4').attr('class', sizing[val]).val('.' + sizing[val]);
            }
        });

        $("#input-span-slider").slider({
            value: 1,
            range: "min",
            min: 1,
            max: 12,
            step: 1,
            slide: function (event, ui) {
                var val = parseInt(ui.value);
                $('#form-field-5').attr('class', 'col-xs-' + val).val('.col-xs-' + val);
            }
        });



        //"jQuery UI Slider"
        //range slider tooltip example
        $("#slider-range").css('height', '200px').slider({
            orientation: "vertical",
            range: true,
            min: 0,
            max: 100,
            values: [17, 67],
            slide: function (event, ui) {
                var val = ui.values[$(ui.handle).index() - 1] + "";

                if (!ui.handle.firstChild) {
                    $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                            .prependTo(ui.handle);
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('span.ui-slider-handle').on('blur', function () {
            $(this.firstChild).hide();
        });


        $("#slider-range-max").slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2
        });

        $("#slider-eq > span").css({width: '90%', 'float': 'left', margin: '15px'}).each(function () {
            // read initial values from markup and remove that
            var value = parseInt($(this).text(), 10);
            $(this).empty().slider({
                value: value,
                range: "min",
                animate: true

            });
        });

        $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item


        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file: 'No File ...',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
        });
        //pre-show a file name, for example a previously selected file
        //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])


        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small'//large | fit
                    //,icon_remove:null//set null, to hide remove/reset button
                    /**,before_change:function(files, dropped) {
                     //Check an example below
                     //or examples/file-upload.html
                     return true;
                     }*/
                    /**,before_remove : function() {
                     return true;
                     }*/
            ,
            preview_error: function (filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function () {
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });


        //$('#id-input-file-3')
        //.ace_file_input('show_file_list', [
        //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
        //{type: 'file', name: 'hello.txt'}
        //]);




        //dynamically change allowed formats by changing allowExt && allowMime function
        $('#id-file-format').removeAttr('checked').on('change', function () {
            var whitelist_ext, whitelist_mime;
            var btn_choose
            var no_icon
            if (this.checked) {
                btn_choose = "Drop images here or click to choose";
                no_icon = "ace-icon fa fa-picture-o";

                whitelist_ext = ["jpeg", "jpg", "png", "gif", "bmp"];
                whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
            }
            else {
                btn_choose = "Drop files here or click to choose";
                no_icon = "ace-icon fa fa-cloud-upload";

                whitelist_ext = null;//all extensions are acceptable
                whitelist_mime = null;//all mimes are acceptable
            }
            var file_input = $('#id-input-file-3');
            file_input
                    .ace_file_input('update_settings',
                            {
                                'btn_choose': btn_choose,
                                'no_icon': no_icon,
                                'allowExt': whitelist_ext,
                                'allowMime': whitelist_mime
                            })
            file_input.ace_file_input('reset_input');

            file_input
                    .off('file.error.ace')
                    .on('file.error.ace', function (e, info) {
                        //console.log(info.file_count);//number of selected files
                        //console.log(info.invalid_count);//number of invalid files
                        //console.log(info.error_list);//a list of errors in the following format

                        //info.error_count['ext']
                        //info.error_count['mime']
                        //info.error_count['size']

                        //info.error_list['ext']  = [list of file names with invalid extension]
                        //info.error_list['mime'] = [list of file names with invalid mimetype]
                        //info.error_list['size'] = [list of file names with invalid size]


                        /**
                         if( !info.dropped ) {
                         //perhapse reset file field if files have been selected, and there are invalid files among them
                         //when files are dropped, only valid files will be added to our file array
                         e.preventDefault();//it will rest input
                         }
                         */


                        //if files have been selected (not dropped), you can choose to reset input
                        //because browser keeps all selected files anyway and this cannot be changed
                        //we can only reset file field to become empty again
                        //on any case you still should check files with your server side script
                        //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
                    });

        });

        $('#spinner1').ace_spinner({value: 0, min: 0, max: 200, step: 10, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
                .closest('.ace-spinner')
                .on('changed.fu.spinbox', function () {
                    //alert($('#spinner1').val())
                });
        $('#spinner2').ace_spinner({value: 0, min: 0, max: 10000, step: 100, touch_spinner: true, icon_up: 'ace-icon fa fa-caret-up bigger-110', icon_down: 'ace-icon fa fa-caret-down bigger-110'});
        $('#spinner3').ace_spinner({value: 0, min: -100, max: 100, step: 10, on_sides: true, icon_up: 'ace-icon fa fa-plus bigger-110', icon_down: 'ace-icon fa fa-minus bigger-110', btn_up_class: 'btn-success', btn_down_class: 'btn-danger'});
        $('#spinner4').ace_spinner({value: 0, min: -100, max: 100, step: 10, on_sides: true, icon_up: 'ace-icon fa fa-plus', icon_down: 'ace-icon fa fa-minus', btn_up_class: 'btn-purple', btn_down_class: 'btn-purple'});

        //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
        //or
        //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
        //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0


        //datepicker plugin
        //link
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function () {
            $(this).prev().focus();
        });

        //or change it into a date range picker
        $('.input-daterange').datepicker({autoclose: true});


        //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
        $('input[name=date-range-picker]').daterangepicker({
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        })
                .prev().on(ace.click_event, function () {
            $(this).next().focus();
        });


        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false
        }).next().on(ace.click_event, function () {
            $(this).prev().focus();
        });

        $('#date-timepicker1').datetimepicker().next().on(ace.click_event, function () {
            $(this).prev().focus();
        });


        $('#colorpicker1').colorpicker();

        $('#simple-colorpicker-1').ace_colorpicker();
        //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
        //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
        //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
        //picker.pick('red', true);//insert the color if it doesn't exist


        $(".knob").knob();


        var tag_input = $('#form-field-tags');
        try {
            tag_input.tag(
                    {
                        placeholder: tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'], //defined in ace.js >> ace.enable_search_ahead
                        /**
                         //or fetch data from database, fetch those that match "query"
                         source: function(query, process) {
                         $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                         .done(function(result_items){
                         process(result_items);
                         });
                         }
                         */
                    }
            )

            //programmatically add a new
            var $tag_obj = $('#form-field-tags').data('tag');
            $tag_obj.add('Programmatically Added');
        }
        catch (e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }


        /////////
        $('#modal-form input[type=file]').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'large'
        })

        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('shown.bs.modal', function () {
            if (!ace.vars['touch']) {
                $(this).find('.chosen-container').each(function () {
                    $(this).find('a:first-child').css('width', '210px');
                    $(this).find('.chosen-drop').css('width', '210px');
                    $(this).find('.chosen-search input').css('width', '200px');
                });
            }
        })
        /**
         //or you can activate the chosen plugin after modal is shown
         //this way select element becomes visible with dimensions and chosen works as expected
         $('#modal-form').on('shown', function () {
         $(this).find('.modal-chosen').chosen();
         })
         */



        $(document).one('ajaxloadstart.page', function (e) {
            $('textarea[class*=autosize]').trigger('autosize.destroy');
            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });

    });
    
    $(window).load(function(){
    $("#ace-settings-container").hide();
    $('.colorpick-btn[style*="background-color:#222A2D;"]').click();
    
    });
    
   
</script>

<!-- the following scripts are used in demo only for onpage help and you don't need them -->
<!--
<link rel="stylesheet" href="<?php echo base_url('assets')?>/css/ace.onpage-help.css" />
<link rel="stylesheet" href="<?php echo base_url('assets')?>/js/themes/sunburst.css" />

<script type="text/javascript"> ace.vars['base'] = '..'; </script>
<script src="<?php echo base_url('assets')?>/js/ace/elements.onpage-help.js"></script>
<script src="<?php echo base_url('assets')?>/js/ace/ace.onpage-help.js"></script>
<script src="<?php echo base_url('assets')?>/js/rainbow.js"></script>
<script src="<?php echo base_url('assets')?>/js/language/generic.js"></script>
<script src="<?php echo base_url('assets')?>/js/language/html.js"></script>
<script src="<?php echo base_url('assets')?>/js/language/css.js"></script>
<script src="<?php echo base_url('assets')?>/js/language/javascript.js"></script>
-->