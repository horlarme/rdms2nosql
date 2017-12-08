<?php

require_once "./vendor/autoload.php";

/**
 * Loading ProcessForm Class
 * @var $a Object
 */
$a = new horlarme\rdms2nosql\ProcessForm;
// header('content-type: application/json');
// echo json_encode($_SERVER);exit;

/**
 * Middleware
 */
$a->middleware();

/**
 * Loading Migrate Class
 * @var $b Object
 */
$b = new horlarme\rdms2nosql\Migrate;

/**
 * Adding Header Template
 */
require_once "./header.php"
?>
        <div class="">
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Information</h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <table>
                            <tr>
                                <td class="strong">Items to migrate</td>
                                <td><?= $b->itemsToMigrate();?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">NoSQL Connection</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nosqlHost">Host Name</label>
                            <input type="text" class="form-control" name="nosqlHost" placeholder="localhost">
                        </div>
                        <div class="form-group">
                            <label for="nosqlPassword">Password</label>
                            <input type="password" class="form-control" name="nosqlPassword">
                        </div>
                        <div class="form-group">
                            <label for="nosqlPort">Port</label>
                            <input type="number" class="form-control" name="nosqlPort" value="27017">
                        </div>
                        <div class="form-group">
                            <label for="nosqlDatabase">Database</label>
                            <input type="text" class="form-control" name="nosqlDatabase" placeholder="my_database">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
/**
 * Loading Footer Template
 */
require_once "./footer.php";
?>