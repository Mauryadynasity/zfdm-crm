<div class="panel panel-info">
  <div class="panel-heading">Protocal List</div>
    <div class="panel-body">
        <div class="row">
        <div class="col-md-4 form-group">
          <label for="">Enter Protocal Message</label>
          <input type="text" class="form-control protocal_messages" required>
          <input type="hidden" name="prospect_id" class="protocol_prospect_id" value="{{$prospect_id}}">        
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
        </tr>
      </thead>
      <tbody>
        @foreach($protocols as $protocol)
        <tr>
          <td>{{$protocol->id}}</td>
          <td>{{$protocol->messages}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    </div>
  </div>

  <script>
$('#protocal_table').DataTable();
function saveProtocolFunction(){
  var message = $('.protocal_messages').val();
  var prospect_id = $('.protocol_prospect_id').val();
  if(message ==''){
    Swal.fire('please type protocol message', '', 'warning')
    return false;
  }
  Swal.fire({
    title: 'Do you want to save?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Save',
    denyButtonText: `Don't save`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        headers: {
          'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        type: 'GET',
        url: "{{ url('admin/save-protocol') }}",
        data: {
          message : message,
          prospect_id : prospect_id,
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
          $('.protocal_messages').val(' ');
          getProtocals(0);
          }
        },
      });
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
    }
  });
}
  </script>