<div class="panel panel-info">
  <div class="panel-heading">Protocal List</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6 form-group">
          <label for="">Enter Protocal Message</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-md-6 form-group">
          <label style="display: block;">&nbsp;</label>
          <button class="btn btn-info">Add Protocal</button>
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
        <tr>
          <td>1</td>
          <td>new message</td>
          <td>02-02-2023</td>
        </tr>
        <tr>
          <td>2</td>
          <td>new message</td>
          <td>02-02-2023</td>
        </tr>
        <tr>
          <td>3</td>
          <td>new message</td>
          <td>02-02-2023</td>
        </tr>
        <tr>
          <td>4</td>
          <td>new message</td>
          <td>02-02-2023</td>
        </tr>
      </tbody>
    </table>

    </div>
  </div>

  <script>
    $('#protocal_table').DataTable();
  </script>