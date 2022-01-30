        <x-partbook-layout>

        <!-- customize css & javascript -->
            <style>
                .ui-combobox {
                    position: relative;
                    display: inline-block;
                    width:100%;
                
            }
            .ui-combobox-toggle {
                position: absolute;
                top: 0;
                bottom: 0;
                margin-left: -1px;
                padding: 0;
                /* adjust styles for IE 6/7 */
                *height: 1.7em;
                *top: 0.1em;
            }
            .ui-combobox-input {
                margin: 0;
                padding: 0.3em;
            }
        </style>

        <script>

            // bfcache remove
            $(window).bind('pageshow', function(event){
            if(event.originalEvent && event.originalEvent.persisted){
                location.reload();
            }
            });

            $(document).ready(function() {
                
                // if no input submit disable
                //$("#btnSubmit").attr("disabled", true);

                var lineNo = 0;
                // button function "add"
                $('#plus5').click(function() {

                    ++lineNo;

                    // reading value from form
                    var partname = $('#partname').val();
                    var machine = $('#machine').val();
                    var qty = $('#qty').val();
                    var quality = $('#quality').val();

                    // require form value				
                    if(partname==''){
                        alert("Please input Part No");
                        $( "#partname" ).focus();
                        return false;
                    
                    }/* else if((quality==null)){
                        alert("Please input "+quality+".");
                        $( "#quality" ).focus();
                        return false;
                    }*/

                    // qty default 1
                    if((qty=='' || qty < 1 )){
                        qty = 1;
                        
                    }

                    if($('#partList').length == 0) 
                    {
                        $('#mainbox').append(

                        '<div class="row" id="partList">'
                        +   '<div class="col-md-6">'
                        +       '<div class="card ">'
                        +           '<div class="card-header ">'
                        +                '<h4 class="card-title">Part list</h4>'
                        +            '</div>'
                        +            '<div class="card-body ">'
                        +                '<form method="post" action="{{route("askprices.store")}}">'
                        +                    '@csrf'
                        +                        '<table class="table">'
                        +                            '<thead>'
                        +                                '<tr>'
                    //    +                                    '<th scope="col">No</th>'
                        +                                    '<th scope="col">Part Name</th>'
                        +                                    '<th scope="col">Machine</th>'
                        +                                    '<th scope="col">Qty</th>'
                        +                                    '<th scope="col"></th>'
                        +                                '</tr>'
                        +                            '</thead>'
                        +                            '<tbody id="askList">' 
                        +                            '</tbody>'
                        +                        '</table>'
                        +                    '<button type="submit" id="btnSubmit" class="btn btn-primary">Excel Download</button>'
                        +                '</form>'
                        +            '</div>'
                        +        '</div>'
                        +   '</div>'
                        );

                    }
                    

                    $('#askList').append(

                        '<tr class="rowAskList">'
                    //    + '<th scope="row">'+lineNo+'</th>'
                        +   '<td>'+partname+'</td>'
                        +   '<td>'+machine+'</td>'
                        +   '<td>'+qty+'</td>'
                        +   '<td><a href="javascript:void(0)" class="btn btn-danger " id="minus5">X</a></td>'
                        + '<input type="hidden" name="partname[]" value="'+partname+'" />'
                        + '<input type="hidden" name="machine[]" value="'+machine+'" />'
                        //+ '<input type="hidden" name="quality[]" value="'+quality+'" />'
                        + '<input type="hidden" name="qty[]" value="'+qty+'" />'
                        + '</tr>'
                        
                    )
                    // add to part list when click add button
                    
                    // when click add input type "text" value reset	
                    var input = $('input[type=text],textarea');
                    input.val("");
                    
                    // when click add reset quality select 
                    //quality = null;

                });
                
                // when click button "remove" will remove row
                $(document).on('click', '#minus5', function() {
                    if ($(".rowAskList").length > 1){
                        $(this).closest('.rowAskList').remove();
                    } else{
                        $("#partList").remove();
                        lineNo = 0;
                    }

                });
        
                // reading code number	
                $( "#partname" ).autocomplete({
                    minLength: 4,
                    source: '/api/part',
                    select: function( event, ui ) {
                    
                        $( "#partname" ).val( ui.item.label );
                        $( "#machine" ).focus();
                    //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
                        return false; 
                    }
                });

                $(function() {
                    $( "#machine" ).autocomplete({
                        source: function( request, response ) {
                    let partname = $('#partname').val();
                    const partno = partname.split(" ");

                        $.getJSON( "/api/machine", {
                            term : request.term,
                            partno : partno[0]
                        }, response );
                                    
                    },
                        minLength: 0,
                        select: function( event, ui ) {
                    
                        $( "#machine" ).val( ui.item.label );
                        $( "#qty" ).focus();
                        return false; 
                }
                    }).focus(function() {
                        $(this).autocomplete("search", "");
                    });
                });
                

            });
        </script>

            <div class="content">
                <div class="container-fluid" id="mainbox" >
                    <div class="row ">
                        <div class="col-md-auto">
                            <div class="card ">
                                <!--<div class="card-header ">
                                   !-- <h4 class="card-title">Email Statistics</h4>
                                    <p class="card-category">Last Campaign Performance</p>
                                </div>-->
                                <div class="card-body ">
                                    <div class="form-row align-items-top" id="dynamic_form">
                                        <div class="col-sm-4 my-1">
                                            <label class="sr-only" for="partname">Part Name</label>
                                            <input type="text" class="form-control" name="partname" id="partname" placeholder="1) Enter *Part No"  >
                                            <small id="partnamehelp" class="form-text text-muted">*Mohon Isi Minimal 4 Digit</small>
                                        </div>
                                        <div class="col-sm-4 my-1">
                                            <label class="sr-only" for="machine">Machine</label>
                                            <input type="text" class="form-control" name="machine" id="machine" placeholder="2) Enter machine"  >
                                        </div>
                                        <!--<div class="col-sm-2 my-1">
                                            <label class="sr-only" for="quality">Quality</label>
                                            <select class="form-control custom-select" name="quality" id="quality" >
                                                <option disabled="disabled" selected="selected" value="">Select quality</option>
                                                <option value="0">Original</option>
                                                <option value="1">kawe</option>
                                                <option value="2">Both</option>
                                            </select>
                                        </div>-->
                                        <div class="col-sm-2 my-1">
                                            <label class="sr-only" for="quality">Qty</label>
                                            <input type="text" class="form-control" type="number" name="qty" placeholder="3) Qty" id="qty" maxlength="4" size="4" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"; ></textarea>
                                        </div>
                                        <div class="col-sm-2 my-1">
                                                <a href="javascript:void(0)" class="btn-block btn btn-primary" id="plus5">Add</a>
                                        </div>
                                    </div>
                                    <!--<div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>-->
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-8">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Users Behavior</h4>
                                    <p class="card-category">24 Hours performance</p>
                                </div>
                                <div class="card-body ">
                                    <div id="chartHours" class="ct-chart"></div>
                                </div>
                                <div class="card-footer ">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Click
                                        <i class="fa fa-circle text-warning"></i> Click Second Time
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>

                <!-- Information -->
                <div class="col-md">
                    <p class="text-justify">
                        * Masukan Isian data form ini sesuai urutan field yang diberikan, untuk mencegah kesalahan data <br />
                        * Jika setelah menginput part no, lalu tidak terdapat Nama mesin, kemungkinan besar part no yang dimasukan salah. / khusus anda pabrik, dapat mengemail pada kami di <a href="mailto:info@partbook.id">info@partbook.id</a>
                    </p>
                </div>

            </div>
        </x-partbook-layout>