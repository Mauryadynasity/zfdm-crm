<div class="panel panel-info">
  <div class="panel-heading">Protocal List</div>
    <div class="panel-body">
          <div class="row">
        <div class="col-md-4 form-group">
          <label for="">Enter Protocal Message</label>
          <input type="text" class="form-control protocal_messages">
        </div>
        <div class="col-md-4 form-group">
                <label>Date</label>
                <input type="date" name="" class="form-control protocol_date" style="width: 100%;" required="">
        </div>
        <div class="col-md-4 form-group">
          <label style="display: block;">&nbsp;</label>
          <button onclick="saveProtocolFunction()" class="btn btn-info">Add Protocal</button>
        </div>
      </div>
    <table class="table table-hover table-responsive" id="protocal_table">
      <thead>
        <tr class="success">
          <th>SN#</th>
          <th>Messages</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach($protocols as $protocol)
        <tr>
          <td>{{$protocol->id}}</td>
          <td>{{$protocol->messages}}</td>
          <td>{{$protocol->date}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    </div>
  </div>

  <script>
$('#protocal_table').DataTable();
function saveProtocolFunction(){
  Swal.fire({
    title: 'Do you want to save the changes?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Save',
    denyButtonText: `Don't save`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var message = $('.protocal_messages').val();
      console.log(message);
      var protocol_date = $('.protocol_date').val();
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/save-protocol') }}",
        data: {
          message : message,
          protocol_date : protocol_date,
        },
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
}
  </script>