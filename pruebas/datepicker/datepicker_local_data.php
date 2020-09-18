<!doctype html>
<html lang="en">
<head>
<link href="css/bootstrap.css" rel="stylesheet"/>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet"/>

<script src="js/jquery.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
</head>
<body>


<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>
</body>
</html>
