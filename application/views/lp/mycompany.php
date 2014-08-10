<style>
th {
    background:#0E202E;
    color: #ffffff;
    border-bottom: 0px !important
}

table th.start {
    border-radius: 5px 0px 0px 0px !important; 
    -moz-border-radius: 5px 0px 0px 0px !important; 
    -webkit-border-radius: 5px 0px 0px 0px !important
}

table th.end {
    border-radius: 0px 5px 0px 0px !important; 
    -moz-border-radius: 0px 5px 0px 0px !important; 
    -webkit-border-radius: 0px 5px 0px 0px !important
}

table th.startend {
    border-radius: 5px 5px 0px 0px !important; 
    -moz-border-radius: 5px 5px 0px 0px !important; 
    -webkit-border-radius: 5px 5px 0px 0px !important
}
</style>
<script type="text/javascript">
jQuery(document).ready(function(){
<?php
if($main) {
    
    ?>
    var origvars = [];
    origvars['name'] = '<?php echo $company['name']?>';
    origvars['website'] = '<?php echo $company['website']?>';
    origvars['address'] = '<?php echo $company['address']?>';
    origvars['telephone'] = '<?php echo $company['telephone']?>';
    origvars['fax'] = '<?php echo $company['fax']?>';
    
    jQuery('input[name=\'company_name\']').bind('keyup paste blur', function(){
        var e = jQuery(this);
        if(e.val() != origvars['name']) {
            jQuery('input[name=\'website\'], input[name=\'address\'], input[name=\'telephone\'], input[name=\'fax\']').val('');
            jQuery('#switch').val(1);
        } else {
            
            jQuery('#switch').val(0);
            jQuery('input[name=\'website\']').val(origvars['website']);
            jQuery('input[name=\'address\']').val(origvars['address']);
            jQuery('input[name=\'telephone\']').val(origvars['telephone']);
            jQuery('input[name=\'fax\']').val(origvars['fax']);
        }
    });
    <?php
}
?>    
});
</script>
<h2 style="text-align: right">My Company</h2>
<div class="table-responsive">
    <div class="row">
        <div class="col-md-3"><?php include_once(dirname(__FILE__) . '/dash_menu.php')?></div>
        <div class="col-md-9">
            <table class="table table-striped">
                <thead>
                    <tr><th class="startend" colspan="3">My Company</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">                            
                        <form class="form-horizontal" action="<?php echo site_url('lp/mycompany')?>" method="post" style="max-width: 700px; margin: auto">
                            <input type="hidden" id="switch" name="switch" value="0" />
                            <div class="row">
				<div class="col-md-12">
                                    
                                    <?php
                                    if(! $company['approved']) {
                                        
                                        ?>
                                        <div class="text-center" style="border: 1px solid #CCC; background: #FFF; border-radius: 5px; margin-bottom: 10px; padding: 5px; color: #009900">Note: You are not yet approved by the Admin of this company. Once approved, you may now see listings of their bids and rates.</div>
                                        <?php
                                    }
                                    ?>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <input<?php echo (empty($companies) ? '' : ' list="companies"' )?> type="text" class="form-control" name='company_name' value="<?php echo $company['name']?>" />
                                            <?php
                                            if(! empty($companies)) {

                                                ?>
                                                <datalist id="companies">
                                                    <?php
                                                    foreach($companies as $co) {
                                                        ?><option value="<?php echo $co->name?>"><?php
                                                    } unset($co);
                                                ?>
                                                </datalist>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Website</label>
                                        <div class="col-sm-9">
                                            <?php
                                            if($main) {
                                                ?><input type="text" class="form-control" name='website' value="<?php echo $company['website']?>" /><?php
                                            } else echo '<b>', $company['website'], '</b>';
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <?php
                                            if($main) {
                                                ?><input type="text" class="form-control" name='address' value="<?php echo $company['address']?>" /><?php
                                            } else echo '<b>', $company['address'], '</b>';
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Telephone</label>
                                        <div class="col-sm-9">
                                            <?php
                                            if($main) {
                                                ?><input type="text" class="form-control" name='telephone' value="<?php echo $company['telephone']?>" /><?php
                                            } else echo '<b>', $company['telephone'], '</b>';
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">FAX</label>
                                        <div class="col-sm-9">
                                            <?php
                                            if($main) {
                                                ?><input type="text" class="form-control" name='fax' value="<?php echo $company['fax']?>" /><?php
                                            } else echo '<b>', $company['fax'], '</b>';
                                            ?>                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                            <input type="submit" class="btn btn-default" name="update" value="Save">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                                                        
                        </td>
                    </tr>
                    
                    <?php
                    if($main) {
                        
                        ?>
                        <tr style="background: #E5E5E5; font-weight: bold"><td colspan="3">Add User / Colleague to your Company</td></tr>
                        <tr><td colspan="3">

                                <form class="form-horizontal" action="<?php echo site_url('lp/mycompany')?>" method="post" style="max-width: 700px; margin: auto">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php
                                        if($error != ''){
                                            ?><div class="text-center" style="margin-bottom: 15px; color: red"><?php echo $error?></div><?php
                                        }

                                        if($error_type == 'confirmation') {

                                            ?>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id?>" />                                                
                                                    <input type="submit" class="btn btn-default" name="confirm_colleague" value="Yes">
                                                    <input type="submit" class="btn" name="cancel_colleague" value="No">
                                                </div>
                                            </div>
                                            <?php

                                        } else {
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="user_email" value="<?php echo $user_email?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="user_password" value="" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <input type="submit" class="btn btn-default" name="add_colleague" value="Add">
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr style="background: #E5E5E5; font-weight: bold"><td colspan="3">Colleagues</td></tr>
                        <?php
                        if(($total = count($colleagues)) > 0) {

                            ?>
                            <tr style="background: #EFEFEF">
                                <td width="45%" style="font-weight: bold">Name</td>
                                <td width="45%" style="font-weight: bold">Email</td>
                                <td width="10%" style="font-weight: bold">Aprroved</td>
                            </tr>
                            <?php
                            for($x=0; $x<$total; $x++) {

                                $row = $colleagues[$x];
                                ?>
                                <tr><td<?php echo ((! $row->approved) ? ' style="font-weight: bold"' : '')?>><?php echo $row->name?></td>
                                    <td<?php echo ((! $row->approved) ? ' style="font-weight: bold"' : '')?>><?php echo $row->email?></td>
                                    <td style="text-align: center"><?php echo (($row->approved == 1) ? 'Yes' : '<form action="' . site_url('lp/mycompany') . '" method="post"><input type="hidden" name="user_id" value="' . $row->id . '" /><input class="btn btn-default" type="submit" name="approve_colleague" title="User is waiting for Approval" value="Approve" /></form>')?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            
                            ?>
                            <tr><td colspan="3">None.</td></tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>