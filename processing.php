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
            <div data-migrate class="btn btn-lg btn-success col-xs-3 col-xs-offset-3">Migrate</div>
            <div data-migrate-stop class="btn btn-lg btn-warning col-xs-3">Stop</div>
            <script>
                /**
                 * Migration Configuration
                 */
                 /**
                  * Determine if the migration to be stopped if set to true and false to allow migrating
                  */
                 isStopped = true;
                 /**
                  * The current number of the item to extract and import
                  */
                 current = 1;
                 /**
                  * The totall number of items that will be looped over
                  */
                 total = <?= $b->itemsToMigrate(); ?>;
                 /**
                  * Create a url which will be sent to the server
                  */
                url = 'response.php?current=' + current + '&total=' + total;

                /**
                 * When the user click on migrate button
                 */
                $('[data-migrate]').click(function(){
                    //Setting isStooped to true
                    isStopped = false;
                    //Starting the migration
                    startMigrate();
                });

                function startMigrate(){

                    /**
                     * Check to see if the migration is asked to be stopped
                     */
                     if(isStopped){
                         //Stop running this function
                        return false;
                     }

                     getResponse(url)
                        .done(function(response){
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
                                     /**
                                      * Clicking the button again after 3 seconds
                                      * Made it to wait for 3 secs because by then the result for the las one would have been recieved
                                      * and we won't be spaming the server
                                      */
                                    setTimeout(function() {
                                        return startMigrate();
                                    }, 3000);
                                }
                             }else if(response.fail){
                                $('.status').text('Retrying Failed').addClass('bg-warning').removeClass('bg-primary');
                                setTimeout(function() {
                                    return startMigrate();
                                }, 5000);
                             }
                         }
                     )
                        .fail(function(){
                            $('.status').text('Retrying Failed').addClass('bg-warning').removeClass('bg-primary');
                            setTimeout(function() {
                                return startMigrate();
                            }, 8000);
                        });
                };

                /**
                 * Send ajax to the server
                 */
                function getResponse(url){
                    return $.get(url);
                }

                /**
                 * Stopping the migration
                 */
                $('[data-migrate-stop]').click(function(){
                    //Stop migration
                    stopMigration();
                });

                function stopMigration(){
                    isStopped = true;
                    $('.status')
                        .text('Extraction Stopped')
                        .addClass('bg-info')
                        .removeClass('bg-warning')
                        .removeClass('bg-primary')
                        .removeClass('bg-success');

                }
            </script>
        </div>
<?php
/**
 * Loading Footer Template
 */
require_once "./footer.php";
?>