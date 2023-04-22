<div class="panel panel-primary">
          <div class="panel-heading">Prospects</div>
          <div class="panel-body">
            
          <table class="table table-bordered border-success table-responsive" id="prospect-table">
          <thead>
              <tr>
                <th>ID</th>
                @foreach($permissions as $permission)
                <th class="{{$permission->column}}_class" @if($permission->status=='no') style="display:none" @endif>{{$permission->column_name}}</th>
                @endforeach
                <th>{{__('messages.action')}}</th>
                </tr>
            </thead>
            <tbody>
              @foreach($prospacts as $prospact)
              <tr data-pid="{{$prospact->id}}">
                <td class="prospact_id">{{$prospact->id}}</td>
                @foreach($permissions as $permission)
                @php $allowed_column = $permission->column; @endphp
                <th class="{{$allowed_column}}_class" @if($permission->status=='no') style="display:none" @endif>{{$prospact->$allowed_column}}</th>
                @endforeach
                <td>
                  <button title="Edit" class="btn btn-primary" onclick="editProspectForm($(this));"><i class="fa fa-edit"></i></button>
                  <a href="{{url('admin/delete-prospact')}}/{{$prospact->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  <button type="button" class="btn btn-info mybutton" title="Add Quotation" data-qexist="{{($prospact->quotation)?'true':'false'}}" onClick="addNewOfferNew($(this))">
                  <i class="fa fa-plus" aria-hidden="true"></i> Add Quotation
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
         


          </div>
        </div>

<script>
$('#prospect-table').DataTable({
  lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, 'All'],
  ],
  dom: 'Bfrtip',
  buttons: [
      {
          text: 'Search Prospect',
          action: function ( e, dt, node, config ) {
              showProspect(3);
          }
      },
      {
          text: 'Add Prospect',
          action: function ( e, dt, node, config ) {
              showProspect(1);
          }
      }
  ]
});

</script>