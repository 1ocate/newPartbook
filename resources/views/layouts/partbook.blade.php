<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
 <!DOCTYPE html>

<html lang="en">

<head>
    <title>Partbook.id - Free Find Part</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon.ico') }}">
    
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('css/light-bootstrap-dashboard.css?v=2.0.0 ') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.css?v=2.0.0 ') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
	
    <!--   Core JS Files   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="{{ asset('js/light-bootstrap-dashboard.js?v=2.0.0 ') }}" type="text/javascript"></script>
    

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
		$(document).ready(function() {
			
			// if no input submit disable
			//$("#btnSubmit").attr("disabled", true);

			// button function "add"
			$('#plus5').click(function() {

				// reading value from form
				var code = $('#code').val();
				var machine = $('#machine').val();
				var qty = $('#qty').val();
				var quality = $('#quality').val();

				// require form value				
				if(code==''){
					alert("Please input code");
					$( "#code" ).focus();
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
					+ '<div class="col-9 mr-auto">'+code+' '+machine+' '+qty+'</div><div class="col-2"><a href="javascript:void(0)" class="btn btn-danger removeRow" id="minus5">X</a></div>'
					+ '<input type="hidden" name="partname[]" value="'+code+'" />'
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
			$( "#code" ).autocomplete({
				minLength: 4,
				source: '/api/part'
				/*select: function( event, ui ) {
				
				$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
				return false; }*/
			});
			
			// for machine input and select combobox
			(function ($) {
			$.widget("ui.combobox", {
				_create: function() {
					var wrapper = this.wrapper = $("<span />").addClass("ui-combobox")
						, self = this;
					
					this.element.wrap(wrapper);

					this.element
						.addClass("ui-state-default ui-combobox-input ui-widget ui-widget-content ui-corner-left")
						.autocomplete($.extend({
							minLength: 0
						}, this.options));

					$("<a />")
						.insertAfter(this.element)
						.button({
							icons: {
								primary: "ui-icon-triangle-1-s"
							},
							text: false
						})
						.removeClass("ui-corner-all")
						.addClass("ui-corner-right ui-combobox-toggle")
						.click(function () {
							if (self.element.autocomplete("widget" ).is(":visible")) {
								self.element.autocomplete("close");
								return;
							}

							$(this).blur();
							
							self.element.autocomplete("search", "");
							self.element.focus();
						});
						$(".ui.combobox").css("width", "100%");
						$(".ui-combobox-input").css("width", "100%");
						$(".ui-combobox-input").width($(".ui-combobox-input").width() - 32);
				},

				destroy: function() {
					this.wrapper.remove();
					$.Widget.prototype.destroy.call(this);
				}
			});
			})(jQuery);

			// for machine input and select combobox
			$("#machine").combobox({
				source: function( request, response ) {
				let partname = $('#code').val();
				const partno = partname.split(" ");

					$.getJSON( "/api/machine", {
						term : request.term,
						partno : partno[0]
					}, response );
								
				},
				selectFirst:true,
				autoFocus: true
			})

			

		});
	</script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
            -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="/" class="simple-text">
                        Partbook.id
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.html">
                            <i class="nc-icon nc-notes"></i>
                            <p>Request Part Pirce</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./user.html">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <!--<li>
                        <a class="nav-link" href="./table.html">
                            <i class="nc-icon nc-notes"></i>
                            <p>Table List</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./typography.html">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Typography</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./icons.html">
                            <i class="nc-icon nc-atom"></i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./maps.html">
                            <i class="nc-icon nc-pin-3"></i>
                            <p>Maps</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./notifications.html">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Notifications</p>
                        </a>
                    </li>-->
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Request Part Pirce </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <!--<ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-palette"></i>
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <i class="nc-icon nc-planet"></i>
                                    <span class="notification">5</span>
                                    <span class="d-lg-none">Notification</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Notification 1</a>
                                    <a class="dropdown-item" href="#">Notification 2</a>
                                    <a class="dropdown-item" href="#">Notification 3</a>
                                    <a class="dropdown-item" href="#">Notification 4</a>
                                    <a class="dropdown-item" href="#">Another notification</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    <span class="d-lg-block">&nbsp;Search</span>
                                </a>
                            </li>
                        </ul>-->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Account</span>
                                </a>
                            </li>
                            <!--<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon">Dropdown</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </li>-->
                            <li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            
            <!-- Page Content -->
            {{ $slot }}
            <!-- End Page Content -->

</body>
<!--   Core JS Files   -->


</html>
