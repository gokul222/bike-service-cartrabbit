<section id="sidebar"> 
  <div class="white-label">
  </div> 
  <div id="sidebar-nav">   
    <ul>
      <li class="active"><a href="<?php echo base_url().'Customer/dashboard';?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url();?>"><i class="fa fa-desktop"></i>Main Website</a></li>
      <li><a href="<?php echo base_url().'Customer/bookingdatalist';?>"><i class="fa fa-calendar-o"></i> Book a service</a></li>
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
              <div class="nav-profile-name"><a href="<?php echo base_url().'home/logout';?>">Logout</a><i class="fa fa-caret-down"></i></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content-header">
      <h1>Dashboard</h1>
      <p>Welcome <?php echo $data['f_user_name']; ?></p>
    </div>
    
  </div>
</section>
<script type="text/javascript">
  $( function() {
  $('#sortable').sortable({
      connectWith: ".column",
      handle: ".widget-header",
      cancel: ".fa-cog",
      placeholder: "portlet-placeholder ui-corner-all"
   });
  $('#sortable').disableSelection();
});
</script>