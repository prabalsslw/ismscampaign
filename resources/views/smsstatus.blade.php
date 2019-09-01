@extends('layout.master')
@section('title', 'ISMS | SMS Status')


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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/fc-3.2.4/fh-3.1.3/r-2.2.1/sc-1.4.3/datatables.min.css"/>

    <script src="js/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="date/jquery.datetimepicker.css" />
    <script src="date/jquery.datetimepicker.full.js"></script> -->
    <link rel="stylesheet" href="bootstrapDtae/css/bootstrap-datepicker.min.css" />
    <script src="bootstrapDtae/js/bootstrap-datepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/fh-3.1.3/sc-1.4.3/datatables.min.css"/>


@endsection


@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(Session::has('flash_message'))
                <div style="font-size: 18px;font-weight: bold;" class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <span class="glyphicon glyphicon-exclamation-sign"></span> {{Session::get('flash_message')}}
            </div>
            @endif
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-line-chart"></i> SMS STATUS</h2>
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
                    <br />
                    <form class="form-horizontal" method="post" action="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <!-- <label>Date From (yyyy-mm-dd) </label> -->
                                <input type="text" name="date_from" id="date_from" class="form-control" placeholder="Date From" style="color: black;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <!--  <label>Date To (yyyy-mm-dd) </label> -->
                                <input type="text" name="date_to" id="date_to" class="form-control" placeholder="Date To" style="color: black;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <!-- <label>Stake Holder</label> -->
                                <select name="stakeholder" id="stakeholder" class="form-control" style="color: black;">
                                    <option selected disabled>Select A Stakeholder</option>
                                    @foreach($sql as $value)
                                        <option value="{{$value->stake_holder}}">{{$value->stake_holder}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-danger btn-block" id="search">Search</button>
                            </div>
                        </div>
                        <div class="col-md-12" id="data">
                            <hr>
                            <table class="table table-bordered table-striped" id="example" style="font-size: 11px;">
                                <thead style="color: #000000;background: linear-gradient(to bottom, #ccccff 0%, #ffffff 100%);">
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Campaign Title</th>
                                        <th>Uploaded Time</th>
                                        <th>Schedule Time</th>
                                        <th>Sent/Confirm Time</th>
                                        <th>Status</th>
                                        <th>Uploaded</th>
                                        <th>Processing</th>
                                        <th>Successful</th>
                                        <th>Fail</th>
                                        <th>Invalid</th>
                                    </tr>
                                </thead>
                                <tbody style="color: #000000;">
                                    <?php $key = 0; ?>
                                        @foreach($isms_summary as $value)
                                        <?php $key++; ?>
                                        <tr>  
                                            <td>{{$key}}</td>
                                            <td>{{$value->stake_holder}}</td>
                                            <td>{{$value->campaign_name}}</td>
                                            <td>{{$value->upload_time}}</td>
                                            <td>{{$value->scheduletime}}</td>
                                            <td>{{$value->approve_time}}</td>
                                            <td>{{$value->smsstatus}}</td>
                                            <td>{{$value->total_upload}}</td>
                                            <td>{{$value->total_processing}}</td>
                                            <td>{{$value->total_success}}</td>
                                            <td>{{$value->total_fail}}</td>
                                            <td>{{$value->total_invalid}}</td>
                                        </tr>  
                                    @endforeach
                                </tbody>
                               <!--  <tfoot style="color: #000000;">
                                    <tr>
                                        <th>#</th>
                                        <th>Client</th>
                                        <th>Campaign Title</th>
                                        <th>Uploaded Time</th>
                                        <th>Schedule Time</th>
                                        <th>Sent/Confirm Time</th>
                                        <th>Status</th>
                                        <th>Uploaded</th>
                                        <th>Processing</th>
                                        <th>Successful</th>
                                        <th>Fail</th>
                                        <th>Invalid</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection


@section('footer')
    <p>Copyright SSL Wireless</p>
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
 
    <script src="js/custom.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/b-print-1.5.1/fh-3.1.3/sc-1.4.3/datatables.min.js"></script>

    <script type="text/javascript">
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf','copy'
            ],
            "scrollX": true
        } );  
    </script>

    <script type="text/javascript">
        // setInterval(function() {
        //     $("#data").html("Loading....");
        //     $("#data").load(location.href+" #data>*","");
        // }, 100);
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



@endsection
