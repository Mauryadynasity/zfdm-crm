        <div class="panel panel-primary">
          <div class="panel-heading">Quatations</div>
          <div class="panel-body">
          
          <table class="table table-bordered" id="quotations-table">
          <thead>
            <tr>
            <th>{{__('messages.sr_no')}}</th>
              <th>{{__('messages.Company Name')}}</th>
              <th>{{__('messages.Customer name')}}</th>
              <th>{{__('messages.Quotation Number')}}</th>
              <th>{{__('messages.Quotation Date')}}</th>
              <th>{{__('messages.action')}}</th>
              </tr>
          </thead>
          <tbody>
            @foreach($quotations as $quotation)
            <tr data-pid="{{$quotation->id}}">
              <td class="prospact_id">{{$quotation->id}}</td>
              <td class="company_name">{{$quotation->company_name}}</td>
              <td>{{$quotation->cust_name}}</td>
              <td>{{$quotation->quotation->quotation_number}}</td>
              <td>{{$quotation->quotation->quotation_date}}</td>
              <td>
                <a href="{{url('admin/view-quotation')}}/{{$quotation->id}}" title="View" class="btn btn-info" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <button title="Edit" class="btn btn-primary" onclick="editQuotationFunc($(this))"><i class="fa fa-edit"></i></button>
                <a href="{{url('admin/delete-quotation')}}/{{$quotation->id}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>


          </div>
        </div>
