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
<h2 style="text-align: right">My Company</h2>
<div class="table-responsive">
    <div class="row">
        <div class="col-md-3"><?php include_once(dirname(__FILE__) . '/dash_menu.php')?></div>
        <div class="col-md-9">
            <table class="table table-striped">
                <thead>
                    <tr><th class="startend">My Company</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        
                            
                        <form class="form-horizontal" action="" method="post" style="max-width: 700px; margin: auto">
                            
                            <div class="row">
				<div class="col-md-12">
                                                            
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='company_name' value="<?php echo $company['name']?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Website</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='website' value="<?php echo $company['website']?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='address' value="<?php echo $company['address']?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Telephone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='telephone' value="<?php echo $company['telephone']?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">FAX</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name='fax' value="<?php echo $company['fax']?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                                                        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
