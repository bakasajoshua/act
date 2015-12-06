<style type="text/css">
	.input-group{
		margin-bottom: 0.5em
	}
	#county-select {
	    width: 168px;
	    height: 30px;
	}
	#sub_county_select {
		height: 30px;
	}
	#county-label{
		height: 30px;
		width: 306px;
		color: white;
		font-weight: 20px;
		padding-left: 0.5em;
		margin-left: 1em;
		/*text: white;*/
	}


	.breadcrumb>li {
	    line-height: 0;
	}

	.breadcrumb>li>a {
		font-weight: 20px;
	}
	
</style>
<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<p>
		<div class="row">
			<div class="col-md-4">
				<form action="<?php echo base_url();?>dashboard/county" method="post" id="form">
					<div class="input-group">
						<?php
							echo $counties;
						?>
					</div>
					<div class="row input-group">
						<div class="col-md-8" id="sub-county">
							<select class="btn btn-info" name="sub_county_select" id="sub_county_select">
								<option value="0">Select Sub County</option>
							</select>
						</div>
						<div class="col-md-4">
							<button style="height:30px;" class="btn btn-primary" type="submit"> Filter </button>
						</div>
						
					</div>
					
				</form>
			</div>
			<div class="col-md-4">
				<div class="row form-group" style="height: 40px;">
					<div class="col-md-9">
	                    <div class="input-group input-daterange">
	                        <input type="text" class="form-control" name="start" placeholder="Date Start" />
	                        <span class="input-group-addon">to</span>
	                        <input type="text" class="form-control" name="end" placeholder="Date End" />
	                    </div>
                    </div>
                    <div class="col-md-3">
	                    <button style="height:30px;" class="btn btn-primary" type="submit"> Filter </button>
                    </div>

                </div>
                <div class="row">
                	<div class="label-info" id="county-label">
                		<center>
                			<ol class="breadcrumb">
								<?php
									echo $breadcrumb;
								?>
							</ol>
						</center>
					</div>
                </div>
                
                
			</div>
		</div>
        
    </p>
	<!-- end page-header -->
	<!-- begin tabs -->
	<div class="col-md-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#default-tab-1" data-toggle="tab">1st-90 Dashboard</a></li>
			<li class=""><a href="#default-tab-2" data-toggle="tab">2nd-90 Dashboard</a></li>
			<li class=""><a href="#default-tab-3" data-toggle="tab">3rd-90 Dashboard</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="default-tab-1">
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container1"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container2"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body"  id="container3"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container4"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container5"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container6"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container7"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container8"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container9"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container10"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container11"></div>
						</div>	
					</div>
					<div class="col-md-4">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container12"></div>
						</div>	
					</div>
					
				</div>
			</div>
			<div class="tab-pane fade" id="default-tab-2">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container13"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container14"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body"  id="container15"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container16"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body"  id="container17"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container18"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container19"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container20"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container21"></div>
						</div>	
					</div>
				</div>
				
			</div>
			<div class="tab-pane fade" id="default-tab-3">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container22"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container23"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body"  id="container24"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container25"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body"  id="container26"></div>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="panel panel-inverse">
				    	    <div class="panel-body" id="container27"></div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end tabs -->
    
</div>
<!-- end #content -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#sub-county').hide(0);
		$('#county-select').change(function(){
			id=$(this).val();
			if (id==0) {
				$('#sub-county').hide();
			} else{
				$('#sub-county').show();
				$('#sub_county_select').children('#removable').remove();
				$.get('<?php base_url();?>dashboard/ajax_get_sub_county/'+id, function(data){
					obj=jQuery.parseJSON(data);
					
					$.each(obj, function(index, value){
						$('#sub_county_select').append('<option id="removable" value="'+value.sub_county_ID+'">'+value.sub_county_name+'</option>');
						// console.log(value.sub_county_name);
					});
				});
			}
			
		});
	});
</script>
<?php 
	$this->load->view('dropdown');
	$this->load->view('dash_2');
?>

