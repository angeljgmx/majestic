<?php

    /********************************************************/
    /* Administrador Web SmartNova                            */
    /* Formularios                                          */
    /* Junio de 2016                                        */
    /********************************************************/

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

$path = "";

require_once $path.'includes/theme.inc.php';

$page_title = "Pagina de prueba";
$meta = "";
$css = "";
$js = "";
$current = "";
$config['pt_subtitle'] = "A ver que tal queda";
CommonHeader($path, $page_title, $meta, $css, $js, $current, $config);



?>

<div class="row">
                        <div class="col-md-12">
                            
                            
    <div class="tab-pane" id="tab_4">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Form Sample </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="#" class="form-horizontal form-row-seperated">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">First Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" placeholder="small" class="form-control" />
                                                                <span class="help-block"> This is inline help </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Last Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" placeholder="medium" class="form-control" />
                                                                <span class="help-block"> This is inline help </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Gender</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control">
                                                                    <option value="">Male</option>
                                                                    <option value="">Female</option>
                                                                </select>
                                                                <span class="help-block"> Select your gender. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Date of Birth</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Category</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control">
                                                                    <option value="Category 1">Category 1</option>
                                                                    <option value="Category 2">Category 2</option>
                                                                    <option value="Category 3">Category 5</option>
                                                                    <option value="Category 4">Category 4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Multi-Value Select</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" multiple>
                                                                    <optgroup label="NFC EAST">
                                                                        <option>Dallas Cowboys</option>
                                                                        <option>New York Giants</option>
                                                                        <option>Philadelphia Eagles</option>
                                                                        <option>Washington Redskins</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC NORTH">
                                                                        <option>Chicago Bears</option>
                                                                        <option>Detroit Lions</option>
                                                                        <option>Green Bay Packers</option>
                                                                        <option>Minnesota Vikings</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC SOUTH">
                                                                        <option>Atlanta Falcons</option>
                                                                        <option>Carolina Panthers</option>
                                                                        <option>New Orleans Saints</option>
                                                                        <option>Tampa Bay Buccaneers</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC WEST">
                                                                        <option>Arizona Cardinals</option>
                                                                        <option>St. Louis Rams</option>
                                                                        <option>San Francisco 49ers</option>
                                                                        <option>Seattle Seahawks</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC EAST">
                                                                        <option>Buffalo Bills</option>
                                                                        <option>Miami Dolphins</option>
                                                                        <option>New England Patriots</option>
                                                                        <option>New York Jets</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC NORTH">
                                                                        <option>Baltimore Ravens</option>
                                                                        <option>Cincinnati Bengals</option>
                                                                        <option>Cleveland Browns</option>
                                                                        <option>Pittsburgh Steelers</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC SOUTH">
                                                                        <option>Houston Texans</option>
                                                                        <option>Indianapolis Colts</option>
                                                                        <option>Jacksonville Jaguars</option>
                                                                        <option>Tennessee Titans</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC WEST">
                                                                        <option>Denver Broncos</option>
                                                                        <option>Kansas City Chiefs</option>
                                                                        <option>Oakland Raiders</option>
                                                                        <option>San Diego Chargers</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Membership</label>
                                                            <div class="col-md-9">
                                                                <div class="radio-list">
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios2" value="option1" /> Free </label>
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios2" value="option2" checked/> Professional </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Street</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">City</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">State</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Post Code</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group last">
                                                            <label class="control-label col-md-3">Country</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control"> </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                    <i class="fa fa-pencil"></i> 1Edit</button>
                                                                <button type="button" class="btn default">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-green-haze"></i>
                                                    <span class="caption-subject font-green-haze bold uppercase">Form Sample</span>
                                                    <span class="caption-helper">some info...</span>
                                                </div>
                                                <div class="actions">
                                                    <a href="javascript:;" class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="javascript:;" class="btn btn-circle btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> Add </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="#" class="form-horizontal form-row-seperated">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">First Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" placeholder="small" class="form-control" />
                                                                <span class="help-block"> This is inline help </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Last Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" placeholder="medium" class="form-control" />
                                                                <span class="help-block"> This is inline help </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Gender</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control">
                                                                    <option value="">Male</option>
                                                                    <option value="">Female</option>
                                                                </select>
                                                                <span class="help-block"> Select your gender. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Date of Birth</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Category</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control">
                                                                    <option value="Category 1">Category 1</option>
                                                                    <option value="Category 2">Category 2</option>
                                                                    <option value="Category 3">Category 5</option>
                                                                    <option value="Category 4">Category 4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Multi-Value Select</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" multiple>
                                                                    <optgroup label="NFC EAST">
                                                                        <option>Dallas Cowboys</option>
                                                                        <option>New York Giants</option>
                                                                        <option>Philadelphia Eagles</option>
                                                                        <option>Washington Redskins</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC NORTH">
                                                                        <option>Chicago Bears</option>
                                                                        <option>Detroit Lions</option>
                                                                        <option>Green Bay Packers</option>
                                                                        <option>Minnesota Vikings</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC SOUTH">
                                                                        <option>Atlanta Falcons</option>
                                                                        <option>Carolina Panthers</option>
                                                                        <option>New Orleans Saints</option>
                                                                        <option>Tampa Bay Buccaneers</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC WEST">
                                                                        <option>Arizona Cardinals</option>
                                                                        <option>St. Louis Rams</option>
                                                                        <option>San Francisco 49ers</option>
                                                                        <option>Seattle Seahawks</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC EAST">
                                                                        <option>Buffalo Bills</option>
                                                                        <option>Miami Dolphins</option>
                                                                        <option>New England Patriots</option>
                                                                        <option>New York Jets</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC NORTH">
                                                                        <option>Baltimore Ravens</option>
                                                                        <option>Cincinnati Bengals</option>
                                                                        <option>Cleveland Browns</option>
                                                                        <option>Pittsburgh Steelers</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC SOUTH">
                                                                        <option>Houston Texans</option>
                                                                        <option>Indianapolis Colts</option>
                                                                        <option>Jacksonville Jaguars</option>
                                                                        <option>Tennessee Titans</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC WEST">
                                                                        <option>Denver Broncos</option>
                                                                        <option>Kansas City Chiefs</option>
                                                                        <option>Oakland Raiders</option>
                                                                        <option>San Diego Chargers</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Membership</label>
                                                            <div class="col-md-9">
                                                                <div class="radio-list">
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios2" value="option1" /> Free </label>
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios2" value="option2" checked/> Professional </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Street</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">City</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">State</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Post Code</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group last">
                                                            <label class="control-label col-md-3">Country</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control"> </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                    <i class="fa fa-pencil"></i> 1Edit</button>
                                                                <button type="button" class="btn default">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                        <div class="portlet light bg-inverse form-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-green-haze"></i>
                                                    <span class="caption-subject font-green-haze bold uppercase">Form Sample</span>
                                                    <span class="caption-helper">some info...</span>
                                                </div>
                                                <div class="actions">
                                                    <div class="portlet-input input-inline input-small">
                                                        <div class="input-icon right">
                                                            <i class="icon-magnifier"></i>
                                                            <input type="text" class="form-control input-circle" placeholder="search..."> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="#" class="form-horizontal form-row-seperated">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">First Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" placeholder="small" class="form-control" />
                                                                <span class="help-block"> This is inline help </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Last Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" placeholder="medium" class="form-control" />
                                                                <span class="help-block"> This is inline help </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Gender</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control">
                                                                    <option value="">Male</option>
                                                                    <option value="">Female</option>
                                                                </select>
                                                                <span class="help-block"> Select your gender. </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Date of Birth</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Category</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control">
                                                                    <option value="Category 1">Category 1</option>
                                                                    <option value="Category 2">Category 2</option>
                                                                    <option value="Category 3">Category 5</option>
                                                                    <option value="Category 4">Category 4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Multi-Value Select</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" multiple>
                                                                    <optgroup label="NFC EAST">
                                                                        <option>Dallas Cowboys</option>
                                                                        <option>New York Giants</option>
                                                                        <option>Philadelphia Eagles</option>
                                                                        <option>Washington Redskins</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC NORTH">
                                                                        <option>Chicago Bears</option>
                                                                        <option>Detroit Lions</option>
                                                                        <option>Green Bay Packers</option>
                                                                        <option>Minnesota Vikings</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC SOUTH">
                                                                        <option>Atlanta Falcons</option>
                                                                        <option>Carolina Panthers</option>
                                                                        <option>New Orleans Saints</option>
                                                                        <option>Tampa Bay Buccaneers</option>
                                                                    </optgroup>
                                                                    <optgroup label="NFC WEST">
                                                                        <option>Arizona Cardinals</option>
                                                                        <option>St. Louis Rams</option>
                                                                        <option>San Francisco 49ers</option>
                                                                        <option>Seattle Seahawks</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC EAST">
                                                                        <option>Buffalo Bills</option>
                                                                        <option>Miami Dolphins</option>
                                                                        <option>New England Patriots</option>
                                                                        <option>New York Jets</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC NORTH">
                                                                        <option>Baltimore Ravens</option>
                                                                        <option>Cincinnati Bengals</option>
                                                                        <option>Cleveland Browns</option>
                                                                        <option>Pittsburgh Steelers</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC SOUTH">
                                                                        <option>Houston Texans</option>
                                                                        <option>Indianapolis Colts</option>
                                                                        <option>Jacksonville Jaguars</option>
                                                                        <option>Tennessee Titans</option>
                                                                    </optgroup>
                                                                    <optgroup label="AFC WEST">
                                                                        <option>Denver Broncos</option>
                                                                        <option>Kansas City Chiefs</option>
                                                                        <option>Oakland Raiders</option>
                                                                        <option>San Diego Chargers</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Membership</label>
                                                            <div class="col-md-9">
                                                                <div class="radio-list">
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios2" value="option1" /> Free </label>
                                                                    <label>
                                                                        <input type="radio" name="optionsRadios2" value="option2" checked/> Professional </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Street</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">City</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">State</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Post Code</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control"> </div>
                                                        </div>
                                                        <div class="form-group last">
                                                            <label class="control-label col-md-3">Country</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control"> </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                    <i class="fa fa-pencil"></i> 1Edit</button>
                                                                <button type="button" class="btn default">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                    </div>                        
                            
                            
                            
                            
                            
                            
                            
                            
                        </div>
                    </div>

<?php
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
 $sjs = "";

CommonFooter($path, $sjs, $jic);

?>