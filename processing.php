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

$b->storeAsSession();

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
                        <table class="table-responsive">
                            <tr>
                                <td><strong>Items to migrate</strong></td>
                                <td><?= $b->itemsToMigrate();?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Process</h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <table>
                            <tr>
                                <td><strong>Processed</strong></td>
                                <td><span class="processedItems">0</span></td>
                            </tr>
                            <tr>
                                <td><strong>Remainings</strong></td>
                                <td><span><?= $b->itemsToMigrate(); ?></span></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td><span class="status bg-primary">Click Migrate Button to Start Migration</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="clearfix"></div>
            <div data-migrate class="btn btn-lg btn-success col-xs-6 col-xs-offset-3">Migrate</div>
            <script>
                /**
                 * Migration Configuration
                 */
                 current = 1;
                 total = <?= $b->itemsToMigrate(); ?>;
                
                $('[data-migrate]').click(function(){

                    url = 'response.php?current=' + current + '&total=' + total;

                     response = getResponse(url);

                     if(response.success){

                        $('.processedItems').text(current)
                        $('.status').text('Extracting').addClass('bg-primary').removeClass('bg-warning');    
                        
                        //Checking if the current is not the last
                        if(total == current){
                            $('.status').text('Completed').addClass('bg-success').removeClass('bg-primary');
                            return $.get('response.php?cleanFlash');
                        }else{
                            //Increase current
                            current++;
                             //Clicking the button again
                             return $('[data-migrate]').click();
                        }
                     }else{
                        $('.status').text('Retrying Failed').addClass('bg-warning').removeClass('bg-primary');
                        $('[data-migrate]').click();
                     }
                });

                function getResponse(url){
                    return $.get(url);
                }
            </script>
        </div>
<?php
/**
 * Loading Footer Template
 */
require_once "./footer.php";
?>