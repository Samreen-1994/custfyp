<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/customcss.css'); ?>" rel="stylesheet">
</head>
<body style="font-family: calibri;">
<?php include 'navbar_template.php'; ?>
<form name="form" action="<?php echo base_url('Project/takeExam'); ?> " method="post">
    <div class="container">
        <?php include 'examiner_projects_template.php'; ?>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>