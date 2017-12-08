<?php

require_once "./vendor/autoload.php";

/**
 * Loading ProcessForm Class
 * @var $a Object
 */
$a = new horlarme\rdms2nosql\ProcessForm;
/**
 * Flash Message
 */
$messages = $a->get();
// if($messages) echo json_encode($messages);

/**
 * Adding Header Template
 */
require_once "./header.php";
?>
    <form action="processing.php" method="POST">
        <div class="">
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default <?= !@$messages['sqlError'] ?:'panel-danger';?>">
                    <div class="panel-heading">
                        <h3 class="panel-title">SQL Connection</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="sqlHost">Host</label>
                            <input type="text" class="form-control" name="sqlHost" placeholder="localhost" value="<?= @$messages['form']['sqlHost'];?>">
                        </div>
                        <div class="form-group">
                            <label for="sqlUsername">Username</label>
                            <input type="text" class="form-control" name="sqlUsername" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="sqlPassword">Password</label>
                            <input type="password" class="form-control" name="sqlPassword">
                        </div>
                        <div class="form-group">
                            <label for="sqlPort">Port</label>
                            <input type="number" class="form-control" name="sqlPort" value="3306">
                        </div>
                        <div class="form-group">
                            <label for="sqlDatabase">Database</label>
                            <input type="text" class="form-control" name="sqlDatabase" placeholder="my_database">
                        </div>
                    </div>
                    <?php
                    /**
                     * Processing Error if available
                     */
                    if(@$messages['sqlError']){
                        ?>
                        <div class="panel-footer"><?= $messages['sqlError']; ?></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default <?= !@$messages['noSqlError'] ?:'panel-danger';?>">
                    <div class="panel-heading">
                        <h3 class="panel-title">NoSQL Connection</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nosqlHost">Host</label>
                            <input type="text" class="form-control" name="nosqlHost" placeholder="localhost">
                        </div>
                        <div class="form-group">
                            <label for="nosqlUsername">Username</label>
                            <input type="text" class="form-control" name="nosqlUsername" placeholder="username">
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
                    <?php
                    /**
                     * Processing Error if available
                     */
                    if(@$messages['noSqlError']){
                        ?>
                        <div class="panel-footer"><?= $messages['noSqlError']; ?></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="">
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Item Counter</h3>
                    </div>
                    <div class="panel-body">
                        <p>Enter the sql query which counts the number of item to process.</p>
                        <input type="text" class="form-control" name="dataCounter"
                               placeholder="SELECT count(*) from users">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">SQL Data Fetch Query</h3>
                    </div>
                    <div class="panel-body">
                        <p>This is the query that fetches that data from your SQL table, all data that will be processed without limit.</p>
                        <p>Name the column fields with the same name expected to be named in NoSQL using 'as' example: <br /><code>SELECT name as 'Username' from users</code></p>
                        <textarea rows="10" class="form-control" name="dataFetch"
                                  placeholder="SELECT * from users"></textarea>
                        <div class="help-block">If the table is relational, use join to join the tables!</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">NoSQL</h3>
                    </div>
                    <div class="panel-body">
                        <p>Collecting information about the imported data.</p>
                        <div class="form-group">
                            <label for="nosqlCollection">Collection</label>
                            <input type="text" class="form-control" name="nosqlCollection"
                                   placeholder="myCollection">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Start" class="form-control btn-block btn-primary">
                </div>
            </div>
        </div>
    </form>
<?php
/**
 * Loading Footer Template
 */
require_once "./footer.php";

/**
 * Cleaning Flash Messages
 */
$a->cleanFlash();

?>