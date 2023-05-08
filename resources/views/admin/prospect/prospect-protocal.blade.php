<div class="panel panel-info">
  <div class="panel-heading">Protocal List</div>
    <div class="panel-body">
          <div class="row">
        <div class="col-md-4 form-group">
          <label for="">Enter Protocal Message</label>
          <input type="text" class="form-control messages">
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
  </script>