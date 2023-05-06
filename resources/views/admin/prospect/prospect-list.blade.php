<div class="panel panel-primary">
          <div class="panel-heading">Prospects</div>
          <div class="panel-body table-responsive">
          <div class="row">
          <div class="col-md-9 form-group text-right">
          <b>Choose Additional Column</b>
          </div>
          <div class="col-md-3 form-group text-right">
          <select class="form-control" onchange="setProspectColumn($(this))">
            @foreach($permissions as $permission)
            @if($permission->status=='no')
            @php $allowed_column = $permission->column; @endphp
            <option value="{{$allowed_column}}">{{$allowed_column}}</option>
            @endif
            @endforeach
          </select>
          </div>
          </div>
          <table class="table table-bordered border-success table-responsive" id="prospect-table">
          <thead>
              <tr>
                <th>SN#</th>
                <th hidden>ID</th>
                @foreach($permissions as $permission)
                <th class="{{$permission->column}}_class" @if($permission->status=='no') style="display:none" @endif>{{$permission->column_name}}</th>
                @endforeach
                <th>{{__('messages.action')}}</th>
                </tr>
            </thead>
            <tbody>
              @foreach($prospacts as $index=>$prospact)
              <tr data-pid="{{$prospact->id}}" style="color:<?=($prospact->getStatus)?$prospact->getStatus->color:''?>">
                <td >{{++$index}}</td>
                <td hidden class="prospact_id">{{$prospact->id}}</td>
                @foreach($permissions as $permission)
                @php $allowed_column = $permission->column; @endphp
                <td class="{{$allowed_column}}_class" @if($permission->status=='no') style="display:none" @endif>{{$prospact->$allowed_column}}</td>
                @endforeach
                <td>
                <div class="action_class">
                  <button title="Edit" class="btn btn-primary" onclick="editProspectForm($(this));"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-info mybutton" title="Add Quotation" data-qexist="{{($prospact->quotation)?'true':'false'}}" onClick="addNewOfferNew($(this))">
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                  </button>
                  <a href="{{url('admin/delete-prospact')}}/{{$prospact->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  <button type="button" class="btn btn-info mybutton" title="Show Protocals" onClick="getProtocals('{{$prospact->id}}')">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                  </button>
                  </div>
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