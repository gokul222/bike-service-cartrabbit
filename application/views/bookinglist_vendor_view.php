<section id="sidebar"> 
  <div class="white-label">
  </div> 
  <div id="sidebar-nav">   
    <ul>
      <li class="active"><a href="<?php echo base_url().'Vendor/dashboard';?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url();?>"><i class="fa fa-desktop"></i>Main Website</a></li>
      <li><a href="<?php echo base_url().'Vendor/bookingdatalist';?>"><i class="fa fa-calendar-o"></i> service List</a></li>
    </ul>
  </div>
</section>
<section id="content">
  <div id="header">
    <div class="header-nav">
      <div class="menu-button">
        <!--<i class="fa fa-navicon"></i>-->
      </div>
      <div class="nav">
        <ul>
          <li class="nav-profile">
            <div class="nav-profile-image">
             <div class="nav-profile-name"><a href="<?php echo base_url().'home/vendorlogout';?>">Logout</a><i class="fa fa-caret-down"></i></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content-header">
      <h1>Booking Service View</h1>
    </div>
    <div class="container mt-5">
  <div class="mt-3">
     <table class="table table-bordered" id="users-list">
       <thead>
          <tr>
             <th>S.no</th>
             <th>Customer Name</th>
             <th>Customer Phoneno</th>
             <th>Customer Email</th>
             <th>Customer Service At</th>
             <th>Customer Workshop Date</th>
             <th>Customer Booking Date</th>
             <th>status</th>
          </tr>
       </thead>
       <tbody>
          <?php $i=1; if($data): ?>
            
          <?php foreach($data as $user): ?>
         <tr>
            <td><?php echo $i;?></td>
             <td><?php echo $user['f_user_name']; ?></td>
             <td><?php echo $user['f_user_email']; ?></td>
              <td><?php echo $user['f_user_phoneno']; ?></td>
             <td><?php echo $serviceat[$user['f_workshop_type']]; ?></td>
             <td><?php echo $user['f_workshop_date']; ?></td>
             <td><?php echo $user['f_workshop_booking_at']; ?></td>
             <td><?php echo $user['f_workshop_status']; ?></td>
          </tr> 
          <?php $i++;?>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
  <form  data-parsley-validate action="<?php echo base_url().'Vendor/bookingdatalistupdate';?>" method="post" name="data-book">
          <label for="cars">Change Status</label>
          <select class="form-control"  name="f_workshop_type" id="f_workshop_type" required="" style="margin-bottom: 13px;">
            <option value="">select</option>
            <option value="pending">Pending</option>
            <option value="progress">Progress</option>
            <option value="completed">Completed</option>
          </select>
          <input type="hidden" name="workshop_id" value="<?php echo $_GET['id']?>">
         <button type="submit" class="btn btn-primary btn-block rounded-pill">Update</button>
</form>
</div>

<script type="text/javascript">$('#f_workshop_type').val('<?php echo $user['f_workshop_status'];?>')</script>
  </div>
</section>

