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

                // button function "add"
                $('#plus5').click(function() {

                    // reading value from form
                    var partname = $('#partname').val();
                    var machine = $('#machine').val();
                    var qty = $('#qty').val();
                    var quality = $('#quality').val();

                    // require form value				
                    if(partname==''){
                        alert("Please input Partname");
                        $( "#partname" ).focus();
                        return false;
                    
                    } else if((quality==null)){
                        alert("Please input "+quality+".");
                        $( "#quality" ).focus();
                        return false;
                    }
                    // qty default 1
                    if((qty=='')){
                        qty = 1;
                        
                    }

                    // add to part list when click add button
                    $('#dynamic_form ').append(
                        '<div class="row">'
                        + '<div class="col-9 mr-auto">'+partname+' '+machine+' '+qty+'</div><div class="col-2"><a href="javascript:void(0)" class="btn btn-danger removeRow" id="minus5">X</a></div>'
                        + '<input type="hidden" name="partname[]" value="'+partname+'" />'
                        + '<input type="hidden" name="machine[]" value="'+machine+'" />'
                        + '<input type="hidden" name="quality[]" value="'+quality+'" />'
                        + '<input type="hidden" name="qty[]" value="'+qty+'" />'
                        + '</div>'
                    );

                    // when click add input type "text" value reset	
                    var input = $('input[type=text],textarea');
                    input.val("");
                    
                    // when click add reset quality select 
                    quality = '';

                });
                
                // when click button "remove" will remove row
                $(document).on('click', '#minus5', function() {
                    $(this).closest('.row').remove();

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
                    }).focus(function() {
                        $(this).autocomplete("search", "");
                    });
                });
                

            });
        </script>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md">
                            <div class="card ">
                                <!--<div class="card-header ">
                                   !-- <h4 class="card-title">Email Statistics</h4>
                                    <p class="card-category">Last Campaign Performance</p>
                                </div>-->
                                <div class="card-body ">
                                    
                                        <div class="form-row align-items-center" id="dynamic_form">
                                            <div class="col-sm-4 my-1">
                                                <label class="sr-only" for="inlineFormInputPartName">PartName</label>
                                                <input type="text" class="form-control" name="partname" id="partname" placeholder="Enter Partname"  >

                                            </div>
                                            <div class="col-sm-4 my-1">
                                                <label class="sr-only" for="inlineFormInputGroupUsername">Machine</label>
                                                <input type="text" class="form-control" name="machine" id="machine" placeholder="Enter machine"  >
                                            </div>
                                            <div class="col-sm-2 my-1">
                                            <select class="form-control custom-select" name="quality" id="quality" >
                                                <option disabled="disabled" selected="selected" value="">Select quality</option>
                                                <option value="0">Original</option>
                                                <option value="1">kawe</option>
                                                <option value="2">Both</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-2 my-1">
	                                            <input type="text" class="form-control"  name="Qty" placeholder="Qty" id="qty" ></textarea>
	                                        </div>
                                            <div class="col-sm-auto my-1">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">2017 Sales</h4>
                                    <p class="card-category">All products including Taxes</p>
                                </div>
                                <div class="card-body ">
                                    <form method="post" action="{{route('askprices.store')}}">
                                        @csrf  
                                        
                                        <button type="submit" id="btnSubmit" class="btn btn-primary">Excel Download</button>
                                    </form>
                                   <!-- <div id="chartActivity" class="ct-chart"></div>-->
                                </div>
                                <!--<div class="card-footer ">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="card  card-tasks">
                                <div class="card-header ">
                                    <h4 class="card-title">Tasks</h4>
                                    <p class="card-category">Backend development</p>
                                </div>
                                <div class="card-body ">
                                    <div class="table-full-width">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" value="">
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" value="" checked>
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" value="" checked>
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" value="">
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Read "Following makes Medium better"</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" value="" disabled>
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Unfollow 5 enemies from twitter</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </x-partbook-layout>