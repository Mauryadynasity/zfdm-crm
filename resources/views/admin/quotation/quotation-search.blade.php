<div class="panel panel-info  action_quotation_panel_3" style="display: none;">
  <div class="panel-heading">Search Quatation By Date</div>
  <div class="panel-body">
            
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="date" class="form-control" id="fromDateQuotation" value="{{date('Y-m-01')}}" max="{{date('Y-m-d')}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="date" class="form-control" id="toDateQuotation" value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}">
            </div>
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-info" onclick="search_quotation()"><i class="fa fa-search"></i> Search</button>
          </div>
      </div>

    </div>
  </div>