@extends('layout.master')
@section('title', 'ISMS | Campaign - Confirm SMS')

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
                <h2><i class="glyphicon glyphicon-bookmark"></i> CONFIRM SMS</h2>
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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Campaign Name</th>
                            <th>SMS Text</th>
                            <th>SMS Length</th>
                            <th>Total Number</th>
                            <th>Total Unit</th>
                            <th>Send Time</th>
                            <th>Schedule Time</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 12px;">
                        <tr>
                            <td>{{$data['campaign_name']}}</td>
                            <td>{{$data['sms_text']}}</td>
                            <td>{{session('msgcount')}}</td>
                            <td>{{$data['total_sms']}}</td>
                            <td>{{$data['total_sms'] * session('msgcount')}}</td>
                            <td>{{$data['send_time']}}</td>
                            <td>{{$data['scheduletime']}}</td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <form method="post" action="confirm-sms">
                    
                                    @if($schedule == 1)
                                        <input type="hidden" name="sms_status" value="18">
                                    @else
                                        <input type="hidden" name="sms_status" value="10">
                                    @endif
                                        <input type="hidden" name="sessionid" value="{{$data['sms_session_id']}}">

                                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                                        <input type="submit" class="btn btn-primary pull-right" name="confirm" value="Confirm">
                                        <button class="btn btn-danger pull-right" onclick="goBack()">Back</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        <script>
			function goBack() {
			    window.history.back();
			}
		</script>
        
        <!-- form validation -->

@endsection
