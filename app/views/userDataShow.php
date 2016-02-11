<?php
$sendData=[];
$sendData['title']="Nurun Nobi Shamim";
inc('inc/header',$sendData);
$data='';
$sl=0;
foreach($dataAll as $row){
    $sl++;
    $data.="
        <tr>
            <td>{$sl}</td>
            <td>{$row->full_name}</td>
            <td>{$row->email}</td>
            <td>{$row->user}</td>
            <td>
                <a href='userEdit/{$row->id}' class='btn btn-info'>
                    <span class='glyphicon glyphicon-pencil'></span>
                </a>
            </td>
            <td>
                <a href='delete/' class='btn btn-danger'>
                    <span class='glyphicon glyphicon-trash'></span>
                </a>
            </td>
        </tr>
    ";
}
?>
<div class="container">
    <div class="col-xs-12">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>S/L</td>
                        <td>Full Name</td>
                        <td>E-Mail</td>
                        <td>User Name</td>
                        <td width="5%">Edit</td>
                        <td width="5%">Delete</td>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $data; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
inc('inc/footer');