@extends('layout.master')
@section('title', 'ISMS | Campaign')

@section('head')
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">
    <!-- editor -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <link href="css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="css/editor/index.css" rel="stylesheet">
    <!-- select2 -->
    <link href="css/select/select2.min.css" rel="stylesheet">
    <!-- switchery -->
    <link rel="stylesheet" href="css/switchery/switchery.min.css" />

    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
    

    <script src="js/jquery.min.js"></script>

    <link rel="stylesheet" href="date/jquery.datetimepicker.css" />
    <script src="date/jquery.datetimepicker.full.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/fh-3.1.3/sc-1.4.3/datatables.min.css"/>

    <link rel="stylesheet" href="bootstrapDtae/css/bootstrap-datepicker.min.css" />
    <script src="bootstrapDtae/js/bootstrap-datepicker.min.js"></script>

    <link rel="stylesheet" href="datatables/dataTables.bootstrap.css">

    <!-- <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" /> -->

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <link rel="stylesheet" href="css/confirm-modal.css" />

@endsection



@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="glyphicon glyphicon-bookmark"></i> CAMPAIGN</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li><a class="close-link"><i class="fa fa-close"></i></a> -->
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        @foreach ($sms_tab as $tab)      <!-- For Tab -->
                            @if($tab['tab_id'] == "1")
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Send SMS</a></li>
                            @elseif($tab['tab_id'] == "2")
                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">History</a></li>
                            @endif
                        @endforeach
                    </ul>

                    <!-- ============ Starting Campaign Send SMS =============== -->
                   
                    <div id="myTabContent" class="tab-content">
                        @foreach ($sms_tab as $tab)      <!-- For Tab -->
                            @if($tab['tab_id'] == "1")
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <br>
                                <!-- <div class="col-md-9 col-md-offset-1"> -->
                                @if(Session::has('flash_message'))
                                    <div style="font-size: 18px;font-weight: bold;" class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <span class="glyphicon glyphicon-exclamation-sign"></span> {{Session::get('flash_message')}}
                                    </div>
                                @elseif(Session::has('success'))
                                    <div style="font-size: 18px;font-weight: bold;" class="alert alert-success alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <span class="glyphicon glyphicon-exclamation-sign"></span> {{Session::get('success')}}
                                    </div>
                                @endif
                                
                                <form class="form-horizontal form-label-left" name="camp" method="post" action="sendsms" id="campaignForm">
                                <div class="col-md-10">
                                	<div class="form-group">
    	                                <label class="col-md-3">Campaign Name</label>
    	                                <div class="col-md-9">
    	                                    <input type="text" name="campaign_name" id="campaign_name" class="form-control" placeholder="Campaign Name" required="required" value="">
    	                                </div>
    	                            </div>

                                	<div class="form-group">
                                        <label class="col-md-3">Campaign Category</label>
                                        <div class="col-md-9">
                                            <select name="campaign_catagory" id="campaign_catagory" class=" form-control" required="required">
                                                <option selected disabled>Select Campaign Category</option>
                                                @foreach($campaign_catagory as $value)
                                                    @if($value['is_parent'] == 1)
                                                    	<option value="{{$value['category']}}">{{$value['category']}}</option>
                                                    @else
                                                        <option value="{{$value['category']}}">{{$value['category']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3">Sub Category</label>
                                        <div id="range_a" class="form-group col-md-9" style="background:#FFFFEB;overflow: auto;padding: 5px;color:black;">
                                        </div>
                                        <div class="col-md-6 col-md-offset-10">
                                            <!-- <div id='totalsms'>0</div> -->
                                            <input type="text" name="totalsms" id="totalsms" style="width:200px;border: 0px;color:blue;font-size: 14px;font-weight: bold;" readonly placeholder="Total Numbers">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3">Language</label>
                                        <div class="col-md-9">
                                            <select name="text_tupe" id="text_tupe" class="form-control" required="required">
                                                <option selected disabled>Select Language</option>
                                                <option value="0">English</option>
                                                <option value="1">Bangla</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Stakeholder</label>
                                        <div class="col-md-9">
                                            <select name="stakeholder" id="stakeholder" class="form-control" required="required">
                                                <option selected disabled>Select A Stakeholder</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Message</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control msgss" rows="4" placeholder='Message Body...' name="message" id="message" wrap="off" required="required" onkeypress="UnicodeConversion()" onkeyup="UnicodeConversion()" onclick="UnicodeConversion()" onblur="UnicodeConversion()" style="line-height: normal;"></textarea>
                                            <div id="shwmsg"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="col-md-3">Unicode</label> -->
                                        <div class="col-md-9">
                                            <textarea class="form-control msgss" rows="2" name="unicode" id="unicode" wrap="on" placeholder='Unicode Message Body...' readonly hidden></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <ul class="stats-overview col-md-9 col-md-offset-3">
                                            <li>
                                                <span class="name"> Total Number of SMS </span>
                                                <span class="value text-success">
                                                    <!-- <div id='msgcount'>0</div> -->
                                                    <input type="text" name="msgcount" id="msgcount" style="width:30px;border: 0px;color:blue;font-size: 14px;font-weight: bold;" readonly>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="name"> Total Characters  </span>
                                                <span class="value text-success">
                                                    <!-- <div id='msglength'>0</div> -->
                                                    <input type="text" name="msglength" id="msglength" style="width:30px;border: 0px;color:blue;font-size: 14px;font-weight: bold;" readonly>
                                                </span>
                                            </li>
                                            <li class="hidden-phone">
                                                <span class="name"> Special Characters</span>
                                                <span class="value text-success">
                                                    <!-- <div id='specialchar'>0</div> -->
                                                    <input type="text" name="specialchar" id="specialchar" style="width:30px;border: 0px;color:blue;font-size: 14px;font-weight: bold;" readonly>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3">Schedule <input type="checkbox" id="checkbox1"></label>
    	                                <div class="col-md-6">
                                        	<input size="16" type="text" name="schedule_time" value="" class="form_datetime form-control" id="datepicker" placeholder="Schedule Date/Time">
                                    	</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-8 col-md-offset-2"><hr>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="datalength" id="datalength">
                                    <!-- <input type="submit" name="submit" id="submitbtn" class="btn btn-primary btn-block" value="SEND MESSAGE"> -->
                                    <input type="submit" name="submit" id="submitbtn" class="btn btn-primary btn-block" value="SEND MESSAGE" data-toggle="confirmation" target="_blank" onclick="conf()">
                                </div>
                                </form>
                            </div>

                        <!-- ============ Ending Campaign Send SMS =============== -->
                        @elseif($tab['tab_id'] == "2")
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                <!-- search start -->
                                <div class="form-horizontal">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="date_from" id="date_from" class="form-control" placeholder="Date From" style="color: black;" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="date_to" id="date_to" class="form-control" placeholder="Date To" style="color: black;" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="stake" id="stake" class="form-control" style="color: black;">
                                                <option selected disabled>Select A Stakeholder</option>
                                                @foreach($sql as $value)
                                                    <option value="{{$value->stake_holder}}">{{$value->stake_holder}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger btn-block" id="search" onclick="datasearch()">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- search end -->

                                <table id="example" class="table table-bordered table-striped" style="box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);">
                                    <thead>
                                        <tr style="background: #FFFFE3;">
                                            <!-- <th>SL #</th> -->
                                            <th>Stake Holder</th>
                                            <th>Campaign</th>
                                            <th>Catagory</th>
                                            <th>Sub Catagory</th>
                                            <th>Sent Time</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Total Number</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                   
                                    <tfoot>
                                    <tr style="color: #000000;font-size:13px;background: linear-gradient(to top, #ccccff 0%, #ffffff 100%);">
                                        <!-- <th>SL #</th> -->
                                        <th>Stake Holder</th>
                                        <th>Campaign</th>
                                        <th>Catagory</th>
                                        <th>Sub Catagory</th>
                                        <th>Sent Time</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Total Number</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('footer')
	<p>SSL Wireless &#174 2018</p>
@endsection



@section('jscript')
		<script src="js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>
        <!-- tags -->
        <script src="js/tags/jquery.tagsinput.min.js"></script>
        <!-- switchery -->
        <script src="js/switchery/switchery.min.js"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="js/moment.min.js"></script>
    	<!-- <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script> -->
        <!-- richtext editor -->
        <script src="js/editor/bootstrap-wysiwyg.js"></script>
        <script src="js/editor/external/jquery.hotkeys.js"></script>
        <script src="js/editor/external/google-code-prettify/prettify.js"></script>
        <!-- select2 -->
        <script src="js/select/select2.full.js"></script>
        <!-- form validation -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
        <!-- textarea resize -->
        <script src="js/textarea/autosize.min.js"></script>

        <script src="js/sslcare.js"></script>
        <script src="js/conversion.js"></script>

        <script>
            autosize($('.resizable_textarea'));
        </script>
        <!-- Autocomplete -->

    
        <script src="js/custom.js"></script>

        
        <!-- form validation -->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#campaignForm").validate({
                    rules:{
                        campaign_name:{
                            required: true,
                        },
                        message:{
                            required: true,
                        },
                        datepicker:{
                            required: true,
                        },
                        stakeholder:{
                            required: true,
                        },
                        campaign_catagory:{
                            required: true,
                        },
                        text_tupe:{
                            required: true,
                        },
                    },
                    messages:{
                        campaign_name:{
                            required: "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;'>Please Enter A Campaign Name</span>",
                        },
                        message: {
                            required: "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;'>Please Enter Message Body</span>",
                        },
                        datepicker: {
                            required: "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;'>Please Select Schedule Date/Time</span>",
                        },
                        stakeholder: {
                            required: "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;'>Please Select A Stakeholder</span>",
                        },
                        campaign_catagory: {
                            required: "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;'>Please Select A Campaign Catagory</span>",
                        },
                        text_tupe: {
                            required: "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;'>Please Select A Text Type</span>",
                        },
                    },

                    submitHandler: function(form) {
                    form.submit();
                  }});
            });
        </script>

        <script type="text/javascript">
            $('#datepicker').datetimepicker({
                format:'Y-m-d H:i',
                minDate:'-1970/01/01',
                maxDate:'+1970/01/31',
                step:15,
                defaultTime:'00:00'
                // theme:'dark'
            });
		</script>  
        <script type="text/javascript">
            $(document).ready(function () {
                $('#datepicker').hide();
                // document.getElementById('datepicker').style.display = "none";
                $('#checkbox1').change(function () {
                    if (!this.checked) 
                    {
                        $('#datepicker').hide('slow');
                        // document.getElementById('datepicker').style.display = "none";
                        document.getElementById('datepicker').readOnly = true;
                        document.getElementById('datepicker').value = "";
                    }
                    if(this.checked)
                    {
                        $('#datepicker').show('fast');
                        // document.getElementById('datepicker').style.display = "inline";
                        document.getElementById('datepicker').readOnly = false;
                        document.getElementById('datepicker').required = true;
                    }
                });
            });
        </script> 
         
        <script type="text/javascript">

        $(document).ready(function() {
            $( "#range_a" ).hide();
            $('select[name="campaign_catagory"]').on('change', function() {
                $( "#range_a" ).empty();
                var x = $(this).val();
                // alert(x);
                // $("#range_b").html("<h3>"+x+"</h3>");
                if(x) {
                $.ajax({
                url: "ajaxcampaign/"+x, 
                type: "GET",
                dataType: "json",
                success: function(data)
                {   
                    var result = "";
                    var _len = data.length, post, i;
                    document.getElementById('datalength').value = data.length;
                    document.getElementById('campaignForm');
                    for (i = 0; i < _len; i++) 
                    {
                        post = data[i];
                        var maxfrom = post.total_number-2;

                        result += '<div class="col-md-12"><div class="col-md-3"><input type="checkbox" id="cx'+i+'" name="category'+i+'" onclick="getSel('+i+')" value="'+post.category+'"> '+post.category+' ('+post.total_number+')</div> <div class="col-md-3"><input name = "from'+i+'" id="from'+i+'" type="text" class="form-control" placeholder="From" onkeyup="keyUp('+i+')" onblur="sumTotal('+i+')" value="" min="1" max="'+post.total_number+'" readonly autocomplete="off"/></div> <div class="col-md-3"><input name = "to'+i+'" id="to'+i+'" type="text" class="form-control" placeholder="To" onkeyup="keyUp('+i+')" onblur="sumTotal('+i+')" readonly autocomplete="off" max="'+post.total_number+'"/></div><div class="col-md-3"><input type="text" class="form-control" placeholder="Total" id="smscount'+i+'" name="smscount'+i+'" readonly value="0"/></div><hr></div>';
                    }
                    result += "</br>";
                    $("#range_a").html(result);
                    $("#range_a").fadeIn(800);

                // $("#range_a").fadeIn(1000);
                //     $( "#range_a" ).show();
                }//succ
                });//ajax
                }
            });//select
        });
        </script>
        <script type="text/javascript">
            
            function keyUp(i)
            {
                var x = document.getElementById('from'+i).value;
                var y = document.getElementById('to'+i).value;
                // document.getElementById('to'+i).min = x;
                a = x-1;
                var z = y-a;var b;
                document.getElementById('smscount'+i).value = z;
                // $('#smscount'+i).append(z);
                // var a = document.getElementById('smscount'+i).value;
                // alert(a);
                // alert(z);
            }
            function getSel(i)
            {
                var x = document.getElementById("cx"+i).checked;
                if (x == true)  
                {
                    // document.getElementById("fx"+i).style.display = "inline";
                    document.getElementById('from'+i).readOnly = false;
                    document.getElementById('to'+i).readOnly = false;
                    document.getElementById('from'+i).required = true;
                    document.getElementById('to'+i).required = true;
                }
                if(x == false)
                {
                    document.getElementById('from'+i).readOnly = true;
                    document.getElementById('to'+i).readOnly = true;
                    
                    var n = document.getElementById('smscount'+i).value;
                    var m = document.getElementById('totalsms').value;

                    document.getElementById('from'+i).value = "";
                    document.getElementById('to'+i).value = "";

                    var q = document.getElementById('smscount'+i).value;
                    sumSubs(q);

                    document.getElementById('smscount'+i).value = "";    
                    document.getElementById('to'+i).pattern = "[0-9.]+";  
                    document.getElementById('from'+i).required = false;
                    document.getElementById('to'+i).required = false;          
                }
            }
            function getAll(i)
            {
                var x = document.getElementById("all"+i).checked;
                // alert(x+"---- id: "+i);
                if (x == true)  
                {
                    // document.getElementById("fx"+i).style.display = "none";
                    document.getElementById('from'+i).readOnly = true;
                    document.getElementById('to'+i).readOnly = true;
                }
                if(x == false)
                { 
                    // document.getElementById("fx"+i).style.display = "inline";
                    document.getElementById('from'+i).readOnly = false;
                    document.getElementById('to'+i).readOnly = false;
                }
            }
            function sumTotal(i)
            {
                var b = document.getElementById('datalength').value;
                var x = document.getElementById('from'+i).value;
                document.getElementById('to'+i).min = x;

                var n,total=0;
                for(n = 0; n < b; n++) 
                { 
                    // var x = document.getElementById("cx"+i).checked;
                    // if (x == true)
                    // {
                        var a = document.getElementById('smscount'+n).value;
                        total = + total +  +a; 
                    // }
                }
                document.getElementById('totalsms').value = total;
                // $('#totalsms').html(total);
            }
            function sumSubs(smsc)
            {
                var x = document.getElementById('totalsms').value;
                var total = (x - smsc);
                document.getElementById('totalsms').value = total;
            }
        </script>
        <script type="text/javascript">
            $("#submitbtn").click(function()
            {
                var msg = document.getElementById('message').value;
                var msgs = msg.toLowerCase();
                res = msgs.split(" ");
                count = res.length;
                string_list = ["sexual","adult","lottery","sex","motherfucker","fucker","bitch","motherchod","shala","fuck","kuttarbacha","kutta","khanki","magi","bainchod","penis","tui","madarchod","beyadob"];
                for(i = 0; i < count; i++)
                {
                    for(j = 0 ; j < string_list.length ; j++)
                    {
                        if(res[i] == string_list[j])
                        {
                            document.getElementById("shwmsg").innerHTML = "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;font-weight: bold;'>Slang Not Allowed ("+ res[i]+")</span>";
                            return false;
                        }
                        else
                        {
                            document.getElementById("shwmsg").innerHTML = "";
                        }
                    }
                }

                var type = document.getElementById('text_tupe').value;
                var tmp_arr = [], i = ac = c1 = c2 = c3 = 0;
                str_data = msg;
                str_data += '';

                while ( i < str_data.length ) 
                {
                    c1 = str_data.charCodeAt(i);

                    if (c1 < 128 || c1=='8216' || c1=='8217' || c1=='8220' || c1=='8221') 
                    {
                        tmp_arr[ac++] = String.fromCharCode(c1);
                        i++;
                    } 
                    else if ((c1 > 191) && (c1 < 224)) 
                    {
                        c2 = str_data.charCodeAt(i+1);
                        tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
                        i += 2;
                    } 
                    else 
                    {
                        c2 = str_data.charCodeAt(i+1);
                        c3 = str_data.charCodeAt(i+2);
                        tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                        i += 3;
                    }
                }
    
                if((tmp_arr.join('').length !=  str_data.length) && type == '0')
                {
                    document.getElementById("shwmsg").innerHTML = "<br><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <span style='color:red;font-weight: bold;'>You are not sending English Message. You are suppose to send English SMS through this Stakeholder.</span>";
                    return false;
                }
                else
                    document.getElementById("shwmsg").innerHTML = "";
                    return true;
                });
        </script>
        <script>
        $(document).ready(function() {
        $('select[name="text_tupe"]').on('change', function() {
        var x = $(this).val();
        if(x) 
        {
            $.ajax({
            url: "ajaxgetstakeholder/"+x, 
            type: "GET",
            dataType: "json",
            success: function(data)
            {
                // alert(x);
                // alert(data);
                $('select[name="stakeholder"]').empty();
                $.each(data, function(key,value) 
                {
                    $('select[name="stakeholder"]').append('<option value="'+ value['id'] +'">'+value['stake_holder']+'</option>');
                });//each
            }//succ
            });//ajax
        }
        else{
            $('select[name="stakeholder"]').empty();
        }
    });//select
    });
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/fh-3.1.3/sc-1.4.3/datatables.min.js"></script>

    <script src="datatables/jquery.dataTables.min.js"></script>
    <script src="datatables/dataTables.bootstrap.min.js"></script>


    <script type="text/javascript">
        // $('#example').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'csv', 'excel', 'pdf','copy'
        //     ]
        //     // "scrollX": true
        // } );  
        // $(document).ready(function () {
        //     $(function () {
        //         $("#example").DataTable();
        //     });
        // });
    </script>
    <script type="text/javascript">
        $('#message').on('keyup',function(){  
            extra = textCounter(document.camp.message, $("#message").val().length);
            total = $("#message").val().length + extra;
            document.getElementById('msglength').value = total;
            // $('#msglength').html(total);
            document.getElementById('specialchar').value = extra;
            // $('#specialchar').html(extra);

            if(total>160)
            {
                total=Math.ceil(total/153);
                // $('#msgcount').val(total);
                // $('#msgcount').html(total);
                document.getElementById('msgcount').value = total;
            }
            else if(total>0)
            {
                // $('#msgcount').val(1);
                // $('#msgcount').html(1)
                document.getElementById('msgcount').value = "1";
            }
            else
                // $('#msgcount').val(0);
                // $('#msgcount').html(0)
                document.getElementById('msgcount').value = "0";
            
        });
        </script> 

        <script type="text/javascript">
        // $('#unicode').hide();
        $('select[name="text_tupe"]').on('change', function() {
            $("#message").val('');
            $("#msgcount").val('');
            $("#msglength").val('');
            $("#specialchar").val('');
            var x = $(this).val();
            if(x == '1')
            {
                // $('#unicode').show();
                $('#message').on('keyup',function(){         
                //if($("#msglength").val()==0 || $("#msglength").val().substring(0,1)=="-")
                //  $("#message").val($("#message").val().substring(0,160));            
                //$('#msglength').val(160-($("#message").val().length));
                total=$("#message").val().length;
                document.getElementById('msglength').value = total;
                document.getElementById('specialchar').value = extra;

                if(total>70)
                {
                    total=Math.ceil(total/67);
                    document.getElementById('msgcount').value = total;
                }
                else if(total>0)
                {
                    document.getElementById('msgcount').value = "1";
                }
                else
                    document.getElementById('msgcount').value = "0";
            });
            }
            if(x == '0') 
            {
                // $('#unicode').hide();
                // $("#unicode").val('');
                $('#message').on('keyup',function(){  
                extra = textCounter(document.camp.message, $("#message").val().length);
                total = $("#message").val().length + extra;
                document.getElementById('msglength').value = total;
                // $('#msglength').html(total);
                document.getElementById('specialchar').value = extra;
                // $('#specialchar').html(extra);

                if(total>160)
                {
                    total=Math.ceil(total/153);
                    // $('#msgcount').val(total);
                    // $('#msgcount').html(total);
                    document.getElementById('msgcount').value = total;
                }
                else if(total>0)
                {
                    // $('#msgcount').val(1);
                    // $('#msgcount').html(1)
                    document.getElementById('msgcount').value = "1";
                }
                else
                    // $('#msgcount').val(0);
                    // $('#msgcount').html(0)
                    document.getElementById('msgcount').value = "0";
                
            });
            }
        });
    </script>

    <script type="text/javascript">
        function UnicodeConversion()
        {
            var x = document.getElementById("message").value;
            var y = convertCP2UTF16(convertChar2CP(x));
            $("#unicode").html(y);
        }
        // var x = document.getElementById("msg").value;
        
    </script>

    <script src="js/bootstrap-confirmation.js"></script>
    <script type="text/javascript">
        // document.getElementById('message').value = "";
        // document.getElementById('message').value = "";
        // $('#message').on('keyup',function(){  
        //     x = document.getElementById('message').value;
        //     // alert(x);
        // });

        function conf()
        {
            x = document.getElementById('message').value;
            if(x != "")
            {
                $('[data-toggle=confirmation]').confirmation({
                    rootSelector: '[data-toggle=confirmation]',
                    title: '<h4>Are you sure, you want to Confirm?</h4>',
                    btnOkLabel: 'Confirm',
                    btnCancelLabel: 'Cancel',
                    html: 'true',
                    popout: 'true',
                    // other options
                });
            }
        }
    </script>

    <!-- ajax data search -->
    <script type="text/javascript">
        $('#date_from').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        });
        $('#date_to').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        });
    </script>

    <script type="text/javascript">
        $('#example').hide();
        function datasearch()
        {
            var fromdate = document.getElementById('date_from').value;
            var todate = document.getElementById('date_to').value;
            var stake = document.getElementById("stake").value;
            if (stake == "Select A Stakeholder") 
            {
                stake = "";
            }
            if(fromdate != "" && todate != "" && stake != "")
            {
                $('#example').show();
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['csv', 'excel', 'pdf','copy'],
                    ajax: {
                        "url": "alldata"+"/"+fromdate+"/"+todate+"/"+stake
                        // "url": "test"
                        //"data": {"fdat": fromdate, "todat": todate, "stak": stake}
                        // "dataSrc": ""
                    },
                    columns: [
                        { "data": "stake_holder" },
                        { "data": "campaign_name" },
                        { "data": "category" },
                        { "data": "sub_category" },
                        { "data": "send_time" },
                        { "data": "number_start_from" },
                        { "data": "number_end_to" },
                        { "data": "total_number" },
                        { "data": "smsstatus" },
                    ],
                    destroy: true
                });  
                // alert(fromdate+"--"+todate+"--"+stake);
            }
            else if(fromdate != "" && todate != "")
            {
                $('#example').show();
                stake = 'null';
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['csv', 'excel', 'pdf','copy'],
                    ajax: {
                        "url": "alldata"+"/"+fromdate+"/"+todate+"/"+stake
                        // "url": "test"
                        //"data": {"fdat": fromdate, "todat": todate, "stak": stake}
                        // "dataSrc": ""
                    },
                    columns: [
                        { "data": "stake_holder" },
                        { "data": "campaign_name" },
                        { "data": "category" },
                        { "data": "sub_category" },
                        { "data": "send_time" },
                        { "data": "number_start_from" },
                        { "data": "number_end_to" },
                        { "data": "total_number" },
                        { "data": "smsstatus" },
                    ],
                    destroy: true
                });  
                // alert(fromdate+"--"+todate);
            }
            else if(stake != "")
            {
                $('#example').show();
                fromdate = 'null';
                todate = 'null';
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['csv', 'excel', 'pdf','copy'],
                    ajax: {
                        "url": "alldata"+"/"+fromdate+"/"+todate+"/"+stake
                    },
                    columns: [
                        { "data": "stake_holder" },
                        { "data": "campaign_name" },
                        { "data": "category" },
                        { "data": "sub_category" },
                        { "data": "send_time" },
                        { "data": "number_start_from" },
                        { "data": "number_end_to" },
                        { "data": "total_number" },
                        { "data": "smsstatus" },
                    ],
                    destroy: true
                });  
                // alert(stake);
            }
        }
    </script>

@endsection
