<div class="container mt-2 home">
       <h4 style="text-align: center;font-size: 27px;font-weight: bold;">Service Availble For</h4>
  <div class="row">
    <?php 
foreach ($data as $key => $value) {
?>
    <div class="col-md-3 col-sm-6 item">
      <div class="card item-card card-block">
    <img src="<?php echo base_url().'/'.$value['f_workshop_photo'];?>" alt="image">
        <div class="card-padding">
          
          <div class="text-right" style="color: #313194;"><i class="material-icons"><?php if($value['f_workshop_disc']!=0){ ?>Offer is <?php echo $value['f_workshop_disc'];?> %<?php }else{ ?>Best Seller<?php }?></i></div>
          
        <h5 class="item-card-title mt-3 mb-3"><?php echo $value['f_workshop_name'];?></h5>
        <p class="card-text"><?php echo $value['f_workshop_desc'];?></p> 
        <?php if(isset($_SESSION['cust_userId'])){?>
          <p id="message<?php echo $value['id'];?>"></p>
        <form id="data-book<?php echo $value['id'];?>" data-id='<?php echo $value['id'];?>' data-parsley-validate action="javascript:void(0);" method="post" name="data-book">
          <label for="cars">Choose a:</label>
          <select class="form-control"  name="f_workshop_type" id="washitem" required="" style="margin-bottom: 13px;">
            <option value="">select</option>
            <option value="1">General service check-up</option>
            <option value="2">Oil change</option>
            <option value="3">Water wash</option>
          </select>
          <input type="date" class="form-control" required="" name="f_workshop_date" id="datepicker workshop_date"><br>
          <input type="hidden" name="f_workshop_id" value="<?php echo $value['id'];?>">
          <input type="hidden" name="f_customer_id" value="<?php echo $_SESSION['cust_userId'];?>">
          <input type="submit" id="submit-book" class="form-control btn btn-primary" value="Submit" style="align-items: center;"><br><br>
        </form>
        <?php }else{ ?>
        <a href="<?php echo base_url().'/home/login';?>" class="form-control btn btn-primary">Login</a><br><br>
        <?php } ?>
       </div>
  </div>
    </div>
  <?php } ?>
  </div>
  
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    var url = '<?php echo base_url(); ?>';
    $(document).ready(function() {
  $(document).on("submit","form",function(e){
    var currentForm = '#'+$(this).attr('id');
    var message = '#message'+$(this).attr('data-id');
       $.ajax({
                    url: url + '/Customer/Customerbooking',
                    type: 'post',
                    data: $(currentForm).serialize(),
                    dataType: 'json',
                    cache: false,
                    success: function (response) {
                      if(response['process']==true)
                       {
                       $(message).fadeIn('slow').delay(1000).fadeOut('slow').html(response['message']);
                       $(message).css("color", "green"); 
                       }
                    }, error: function (error) {
                        $(message).fadeIn(1000).html('<p>Please try again</p>');
                    }
                });
    
 });
   });
</script>


