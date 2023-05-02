@extends('admin.layouts.app')
@section('content')

@php
$allowed_columns = $permissions->pluck('column')->toArray();
@endphp

@section('styles')
<style>
  #quotations-table,
  #prospect-table{
    width: 100% !important;
  }
  .trRow{
    display: none;
  }
  .action_class{
    width: 150px !important;
    display: block;
  }
</style>
@endsection


<section class="content-header">
    
    <h1>
    Prospects Details
    <!-- <small>Control panel</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{__('messages.home')}}</a></li>
    <li class="active">Prospects</li>
    </ol>
</section>


    <!-- Main content -->

  <section class="content">

    <!-- Tab for Setting -->
  <div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Prospects</a></li>
      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Quatations</a></li>
    </ul>

    <div class="tab-content">
        <!-- Prospect related code -->
      <div class="tab-pane active" id="tab_1">

        @include('admin.prospect.prospect-search')
        @include('admin.prospect.add-prospect')
        @include('admin.prospect.edit-prospect')
        <div id="prospect-container-box">
        @include('admin.prospect.prospect-list')
        </div>
        @include('admin.quotation.add-quotation')

      </div>
          <!-- Prospect related codes -->
      
          <!-- Quotation related codes -->
      <div class="tab-pane " id="tab_2">

      @include('admin.quotation.edit-quotation')
      @include('admin.quotation.quotation-search')
      <div id="quotation-container-box">
      @include('admin.quotation.quotation-list')
      </div>
           
     
      </div>
        <!-- Quotation related codes -->

    </div>
  </div>
</section>

@section('scripts')
<script>
// all prospect related codes

showProspect(0);

function showProspect(type){
  $('.action_prospect_panel_1, .action_prospect_panel_2, .action_prospect_panel_3').hide();
  if(type>0){
    $('.action_prospect_panel_'+type).show();
    $('html, body').animate({
        scrollTop: $('.nav-tabs-custom').offset().top
    }, 500);
  }
}

// add prospect code
$('#myForm').validate({
    rules : {
      cust_email : { 
        remote: {
          url: "{{ url('admin/is-email-unique') }}", // the URL of the PHP script that validates the email
          type: 'GET'
        }
       },
       cust_phone : {
        remote: {
          url: "{{ url('admin/is-phone-unique') }}", // the URL of the PHP script that validates the email
          type: 'GET'
        }
       }
    },
    messages:{
      cust_email: {
        remote: 'This Email Id is already exists.'
      },
      cust_phone: {
        remote: 'Phone number is already exists.'
      }
    }
});

checkEmailorPhone();
function checkEmailorPhone(){
  var add_cust_email = $('#add_cust_email').val();
  var add_cust_phone = $('#add_cust_phone').val();
  $('#add_cust_email, #add_cust_phone').prop('required',true);
  if(add_cust_email!=''){
    $('#add_cust_phone').prop('required',false);
  }
  if(add_cust_phone!=''){
    $('#add_cust_email').prop('required',false);
  }
}
checkEditEmailorPhone();
function checkEditEmailorPhone(){
  var edit_cust_email = $('#edit_cust_email').val();
  var edit_cust_phone = $('#edit_cust_phone').val();
  $('#edit_cust_email, #edit_cust_phone').prop('required',true);
  if(edit_cust_email!=''){
    $('#edit_cust_phone').prop('required',false);
  }
  if(edit_cust_phone!=''){
    $('#edit_cust_email').prop('required',false);
  }
}

$('#myForm').submit(function(e) {
  e.preventDefault();
  if($(this).valid()==false) {
        return false;
  }

  Swal.fire({
    title: 'Do you want to save the changes?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Save',
    denyButtonText: `Don't save`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var formData = new FormData(this);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'POST',
        url: "{{ url('admin/save-prospact') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          if(data.status == true){
            Swal.fire({
              position: 'top-middle',
              icon: 'success',
              title: data.message,
              // html: 'Ok',
              showConfirmButton: false,
              timer: 3000
            });
          $('#myForm').trigger("reset");
          showProspect(0);
          search_quotation();
          search_prospect();
          }
        },
      });
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
    }
  });
});

    // add prospect code

// edit prospect code
$('#editForm').validate({
    rules : {
      cust_email : { 
        remote: {
          url: "{{ url('admin/is-email-unique-edit') }}", // the URL of the PHP script that validates the email
          type: 'GET'
        }
       },
       cust_phone : {
        remote: {
          url: "{{ url('admin/is-phone-unique-edit') }}", // the URL of the PHP script that validates the email
          type: 'GET'
        }
       }
    },
    messages:{
      cust_email: {
        remote: 'This Email Id is already exists.'
      },
      cust_phone: {
        remote: 'Phone number is already exists.'
      }
    }
});
   $('#editForm').submit(function(e) {
    e.preventDefault();
    checkEditEmailorPhone();
      if($(this).valid()==false) {
            return false;
      }
  Swal.fire({
    title: 'Do you want to save the changes?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Save',
    denyButtonText: `Don't save`,
    }).then((result) => {
      var formData = new FormData(this);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'POST',
        url: "{{ url('admin/update-prospact') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          if(data.status){
            Swal.fire({
              position: 'top-middle',
              icon: 'success',
              title: data.message,
              // html: 'Ok',
              showConfirmButton: false,
              timer: 3000
            });
          $('#editForm').trigger("reset");
          showProspect(0);
          search_prospect();
          }else{
            // alert(data.message);
          }
        },
      });
      });
    });

 function editProspectForm($this){
  var current_tr = $this.closest('tr');
  var prospect_id = current_tr.find('.prospact_id').text();
  $('.prospact_id').val(prospect_id);
  var cust_name = current_tr.find('.cust_name_class').text();
  $('.cust_name').val(cust_name);
  var company_name = current_tr.find('.company_name_class').text();
  $('.company_name').val(company_name);
  var cust_email = current_tr.find('.cust_email_class').text();
  $('.cust_email').val(cust_email);
  var cust_phone = current_tr.find('.cust_phone_class').text();
  $('.cust_phone').val(cust_phone);
  var date_of_contact = current_tr.find('.date_of_contact_class').text();
  $('.date_of_contact').val(date_of_contact);
  var street_name = current_tr.find('.street_name_class').text();
  $('.street_name').val(street_name);
  var post_code = current_tr.find('.post_code_class').text();
  $('.post_code').val(post_code);
  var place_name = current_tr.find('.place_name_class').text();
  $('.place_name').val(place_name);
  var company_address = current_tr.find('.invoice_address_class').text();
  $('.company_address').val(company_address);
  var supply_address = current_tr.find('.supply_address_class').text();
  $('.supply_add_data').val(supply_address);
  var supply_street = current_tr.find('.supply_street_class').text();
  $('.supply_street_data').val(supply_street);
  var supply_post_code = current_tr.find('.supply_post_code_class').text();
  $('.supply_place_code').val(supply_post_code);
  var supply_place_data = current_tr.find('.supply_place_class').text();
  $('.supply_place_data').val(supply_place_data);
  var wants_offer = current_tr.find('.wants_offer_class').text();
  $('.wants_offer').val(wants_offer);
  var no_employee = current_tr.find('.no_employee_class').text();
  $('.no_employee').val(no_employee);
  var no_device = current_tr.find('.no_device_class').text();
  $('.no_device').val(no_device);
  var device_type = current_tr.find('.device_type_class').text();
  $('.device_type').val(device_type);
  var callback = current_tr.find('.callback_class').text();
  $('.callback').val(callback);
  var status = current_tr.find('.status_class').text();
  $('.status').val(status);
  var news = current_tr.find('.news_class').text();
  $('.news').val(news);
  var protocol = current_tr.find('.protocol_class').text();
  $('.protocol').val(protocol);
  var invoice_address = current_tr.find('.invoice_address_class').text();
  $('.invoice_address').val(invoice_address);
  var supply_address_checked_class = current_tr.find('.supply_address_checked_class').text();
  if(parseInt(supply_address_checked_class)==1){
    $('.supply_address_checked').prop('checked', true);
    $('.supply_address').hide();
  }else{
    $('.supply_address_checked').prop('checked', false);
    $('.supply_address').show();
  }
  var supply_add = current_tr.find('.supply_address_class').text();
  $('.supply_add').val(supply_add);
  showProspect(2);
 }

 function search_prospect(){
  var fromDate = $('#fromDate').val();
  var toDate = $('#toDate').val();
  if(fromDate=='' || toDate==''){
    return false;
  }
  $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/prospact-list') }}",
        data: {
            'fromDate' : fromDate,
            'toDate' : toDate,
        },
        success: function(data) {
          if(data.success==true){
            $('#prospect-container-box').html(data.html);
          }else{
            alert('Some Error Occurred.');
          }
        },
      });
 }

 // edit prospect code
 // all prospect related codes done
 
 // all quotation related codes

showQuotation(0);

function showQuotation(type){
  if(type==3){
    $('.action_quotation_panel_3').show();
    $('html, body').animate({
        scrollTop: $('.nav-tabs-custom').offset().top
    }, 500);
  }else{
    $('.action_quotation_panel_3').hide();
  }
}

// add quotation
function addNewOfferNew($this){
      var selectedTr = $this.closest('tr');
      var prospact_id = selectedTr.data('pid');
      var qexist = $this.data('qexist');
      if(qexist==true){
        Swal.fire({
          position: 'top-middle',
          icon: 'warning',
          title: 'Quotation is already created',
          showConfirmButton: false,
          timer: 3000
        });
        return false;
      }
      console.log(prospact_id);
      $('#modal-default').modal('show');
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/get-prospact-details') }}",
        data: {
            'prospact_id' : prospact_id,
        },
        success: function(data) {
          if(data){
            $(".prospact_id").val(data.id);
            $(".cus-name").html(data.cust_name);
            $(".company-name").html(data.company_name);
            $(".street_name").html(data.street_name);
            $(".post_code").html(data.post_code);
            $(".place_name").html(data.place_name);
            $(".quotation_number").html(data.id);
          }else{
          }
        },
      });
  }
function editQuotationFunc($this){
      var selectedTr = $this.closest('tr');
      var prospact_id = selectedTr.data('pid');
      console.log(prospact_id);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/edit-quotation') }}/"+prospact_id,
        data: {
            'prospact_id' : prospact_id,
        },
        success: function(data) {
          if(data.success==true){
            $('#edit-modal-default').modal('show');
            $('#edit-modal-default .modal-body').html(data.html);
          }else{
            alert('Some Error Occurred.');
          }
        },
      });
  }

  $('#saveOffers').validate();
  $('#saveOffers').submit(function(e) {
      e.preventDefault();
      if($(this).valid()==false) {
            return false;
      }
      var formData = new FormData(this);
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'POST',
        url: "{{ url('admin/save-quotation') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          if(data.status){
            Swal.fire({
              position: 'top-middle',
              icon: 'success',
              title: data.message,
              showConfirmButton: false,
              timer: 3000
            });
            $('#saveOffers').trigger("reset");
            $('#modal-default').modal('hide');
            search_quotation();
            search_prospect();
          }else{
            Swal.fire({
              position: 'top-middle',
              icon: 'error',
              title: data.message,
              showConfirmButton: false,
              timer: 3000
            });
          }
        },
      });
    });

    function addOffer($this){
      var currentTrHtml = $this.closest('tr').html();
      $('.offerTable').find('tbody').append("<tr>"+currentTrHtml+"</tr>");
      $this.closest('tr').find('.add-more').hide();
      $this.closest('tr').find('.add-more-remove').show();
    }
    function removeOffer($this){
      if(confirm("Are you sure?") == false){
        return false;
      }
      $this.closest('tr').remove();
    }

  // $('#saveOffers').validate();
$.validator.addMethod("cValidate", function(value, element, min) {
    var message = false;
    if(value==0){
      message = true;
    }
    if(value.length>4){
      message = true;
    }
    return message;
}, "Please provide atleast 5 characters or 0.");

$('#saveOffers').validate({
  rules: {
    comments: {
      required: true,
      cValidate: true
    },
  },
  errorPlacement: function (error, element) {
    var name = $(element).attr("name");
    error.appendTo($("#" + name + "_validate"));
},
});

  function saveOffersFunction(){
  $('#saveOffers').submit();
  }

  function calculateTotalPrice($this){
    var currentTr = $this.closest('tr');
    var prise_per_article = currentTr.find('.prise_per_article').val();
    var number_of_article  = currentTr.find('.number_of_article').val();
    var total_price = parseInt(prise_per_article) * parseInt(number_of_article);
    if(Number.isInteger(total_price)){
      currentTr.find('.price').val(total_price);
      currentTr.find('.price_text').html('$'+total_price);
    }
    calculateGrandTotalPrice(total_price);
  }
  function calculateGrandTotalPrice(total_price){
    var grandTotal = 0;
    $('.price').each(function(total_price) {
      var price = parseInt($(this).val());
      if(Number.isInteger(price)){
        grandTotal += price;
      }
    }); 
    if(Number.isInteger(grandTotal)){
      var gstNumber = parseFloat((grandTotal*'{{$settingDetails->ust_number}}')/100);
      $('.subtotal').html('$'+grandTotal);
      $('.gstNumber').html('$'+gstNumber);
      $('.grandTotal').html('$'+(grandTotal+gstNumber));
      $('.subtotal_val').val(grandTotal);
      $('.gstNumber_val').val(gstNumber);
      $('.grandTotal_val').val((grandTotal+gstNumber));
    }
  }


  function search_quotation(){
  var fromDate = $('#fromDateQuotation').val();
  var toDate = $('#toDateQuotation').val();
  if(fromDate=='' || toDate==''){
    return false;
  }
  $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/quotation-list') }}",
        data: {
            'fromDate' : fromDate,
            'toDate' : toDate,
        },
        success: function(data) {
          if(data.success==true){
            $('#quotation-container-box').html(data.html);
          }else{
            alert('Some Error Occurred.');
          }
        },
      });
 }


  function addTr($this){
    var position_count = $this.closest('table').find('.article_description').length;
    position_count = position_count + 1;
    var content = $('.get_single_quotation_row .trRow').html();
    var positionDetails = '<td><span class="position_text">'+position_count+'</span></td>';
    var content_text = '<tr>'+positionDetails+content+'</tr>';
    $this.closest('table').find('tbody').append(content_text);
  }

  function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function setProspectColumn($this){
  var column_name = $this.val();
  $('.'+column_name+'_class').toggle();

}
// Add supply address column in prospect
$(document).ready(function() {
  $('.supply_address').hide();
    $('.exampleCheckbox').change(function() {
      if ($(this).prop('checked')) {
            $('.supply_address').hide();
        } else {
          $('.supply_address_remove').val('');
          $('.supply_address').show();
        }
    });
});
</script>
@endsection

    @endsection
