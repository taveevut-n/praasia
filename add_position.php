<?php include('head.php'); ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include('topnav.php'); ?>
  <?php include('sidemenu.php'); ?>
    <!-- Content Wrapper. Contains page content -->
    
    <?php
		if ($_POST["submit"]) {
			if ($_POST["e_id"]) {
				$q = mysql_query( "UPDATE `position` SET `position_name` = '".$_POST["position_name"]."' WHERE `position_id` = '".$_POST["e_id"]."' ");
				al('แก้ไขข้อมูลเรียบร้อยแล้ว');
				redi2();	
			} else {
				$q = mysql_query( "INSERT INTO position (`position_id`, `position_name`, `level`, `position_order`) 
				VALUES ('', '".$_POST["position_name"]."', '".$_POST["position_level"]."', '".$_POST["position_order"]."')" );
				al('เพิ่มข้อมูลเรียบร้อยแล้ว');
				redi2();							
			}
		}
		
		if ($_GET["del_id"]) {
				$q = mysql_query( "DELETE FROM `position` WHERE `position_id` = '".$_GET["del_id"]."' " );
				redi2();
		}
		
	?>
    
  <div class="content-wrapper">
	<?php include('breadcamp.php'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">จัดการสังกัด กอง/ฝ่าย</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
					<?php 		
					if($_GET["e_id"]) {
                        $q_edit = mysql_query("SELECT * FROM position WHERE position_id = '".$_GET["e_id"]."' ");
                        $r_edit = mysql_fetch_array($q_edit);
					}
                    ?>                	
                    <form method="post" action="">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">กอง/สำนัก</label>
                        <div class="col-sm-10">
                          <select name="position_level" class="form-control">
                          	<option value="0" selected="selected">กอง/สำนัก</option>
                            <?php 		
								$q = mysql_query("SELECT * FROM position WHERE level = '0' ORDER BY position_order ");
								while($r = mysql_fetch_array($q)) {
							?>
                          	<option value="<?php echo $r["position_id"];?>"><?php echo $r["position_name"];?></option>
                            <?php } ?>                                                                               
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ชือกอง งาน/ฝ่าย</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="ชื่อกอง งาน/ฝ่าย" name="position_name" value="<?php if($_GET["e_id"]) { echo $r_edit["position_name"]; } else { echo ''; }?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ลำดับ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="" name="position_order" value="<?php if($_GET["e_id"]) { echo $r_edit["position_order"]; } else { echo ''; }?>">
                        </div>
                      </div>                      

                      <div class="form-group row">
                        
                        <div class="col-sm-10">
                          <input type="hidden" name="e_id" value="<?php echo $_GET["e_id"]; ?>" >
                          <input type="submit" class="btn btn-primary" name="submit" value="บันทึกข้อมูล">
                        </div>
                      </div>                                                                                                                                                                   
                    </form>             
                </div>
					</div>
				</div>
			</div>
            
		<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">รายการข้อมูลกอง/สำนัก ฝ่าย/งาน</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th scope="col">ชื่อ</th>
                                          <th scope="col">แก้ไข</th>
                                          <th scope="col">ลบ</th>
                                        </tr>
                                      </thead>
                                      <tbody>
											<?php 		
                                                $q = mysql_query("SELECT * FROM position WHERE level = '0' ORDER BY position_order ");
                                                while($r = mysql_fetch_array($q)) {
                                            ?>                                      
                                        <tr style="background-color:#DDD;">
                                          <td><?php echo $r["position_name"]; ?></td>
                                          <td><a href="?e_id=<?php echo $r["position_id"];?>"><i class="fa fa-edit"></i></a></td>
                                          <td><a href="?del_id=<?php echo $r["position_id"];?>"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        	<?php 		
                                                $q2 = mysql_query("SELECT * FROM position WHERE level = '".$r["position_id"]."' ORDER BY position_order ");
                                                while($r2 = mysql_fetch_array($q2)) {
                                            ?> 
                                        <tr style="font-size:12px">
                                          <td>- <?php echo $r2["position_name"]; ?></td>
                                          <td><a href="?e_id=<?php echo $r2["position_id"];?>"><i class="fa fa-edit"></i></a></td>
                                          <td><a href="?del_id=<?php echo $r2["position_id"];?>" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')"><i class="fa fa-trash"></i></a></td>
                                        </tr>
											<?php } }?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>                 
                </div>
					</div>
				</div>
			</div>            
    	</div>
    </section>                 
	<?php include('script.php'); ?>
</body>
</html>
