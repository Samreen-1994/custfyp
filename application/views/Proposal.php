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
<form name="form" action="<?php echo base_url('ProposalController/TakeProposal'); ?> " method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 style="font-weight:bold;color:black;font-size:20px;"><?php echo $this->session->userdata('proID') ?>
                    : <?php echo $this->session->userdata('ptitle') ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class='text-success'>
                    <?php echo $this->session->flashdata('msg'); ?>
                </p>
                <table class="table table-responsive table-hover table-condensed">
                    <?php $Questions = $this->session->userdata('Questions'); ?>
                    <?php $count = 0;
                    foreach ($Questions as $Q) { ?>
                        <tr style="font-size:15px;color:black;font-family:calibri;">
                            <td>
                                <p>
                                    <?php echo "$Q->question_text"; ?>
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" name="option<?php echo $Q->Question_id ?>" value="1"> Yes<br>
                            </td>
                        </tr>
                        <?php ++$count;
                    }
                    $this->session->set_userdata('questions', $count); ?>
                    <tr>
                        <td>
                            <h5 style="font-family:calibri;color:black;font-weight:bolder;">Comments :</h5>
                            <textarea class="form-control" rows="3" id="textArea" name="tcomments" required="true"
                                      required="true"></textarea>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="font-family:calibri;color:black;font-weight:bolder;">Status : </h5>
                            <input type="radio" name="status" value="A" required="true"> Approve<br>
                            <input type="radio" name="status" value="R" required="true"> Re-Exam<br>
                            <input type="radio" name="status" value="F" required="true"> Fail<br>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Submit Proposal" class="btn btn-primary">
                        </td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>