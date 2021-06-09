<section id="sidebar"> 
  <div class="white-label">
  </div> 
  <div id="sidebar-nav">   
    <ul>
      <li class="active"><a href="<?php echo base_url().'Vendor/dashboard';?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url();?>"><i class="fa fa-desktop"></i>Main Website</a></li>
      <li><a href="<?php echo base_url().'Vendor/bookingdatalist';?>"><i class="fa fa-calendar-o"></i>service List</a></li>
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
      <h1>Booking Service History</h1>
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
             <th>Action</th>
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
              <td><?php if($user['f_workshop_status']=='completed'){?>
              Completed
              <?php }else{?>
                <a title="" href="<?php echo base_url().'Vendor/bookingview?id='.$user['bookid'];?>" class="btn btn-info" data-original-title="Edit animal record">Edit
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a><?php } ?></td>
          </tr> 
          <?php $i++;?>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
</div>
  </div>

</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#users-list').DataTable({
        "iDisplayLength": 5, 
   });

  } );
</script>