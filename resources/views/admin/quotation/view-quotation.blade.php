<html>
<body>
  <div id="snippetContent">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="page-content container">
      <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">  Quotation No. #{{sprintf('%06d', $prospact->quotation->quotation_number)}} </small>
        </h1>
        <div class="page-tools">
          <div class="action-buttons">
            <a class="btn bg-white btn-light mx-1px text-95" onclick="window.print();">
              <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i> Print </a>
            <!-- <a class="btn bg-white btn-light mx-1px text-95" href="{{url('admin/view-quotation')}}/{{Request()->id}}?generate_pdf=true" data-title="PDF">
              <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i> Export </a> -->
          </div>
        </div>
      </div>
      <div class="container px-0">
        <div class="">
          <div class="col-12 col-lg-12">
            <div class="row">
              <div class="">
                <div class="text-left text-150">
                <img src="{{asset('images/logo.png')}}" alt="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="padding: 0px;">
                <hr>
              </div>
              </div>
            <div class="row">
              <div class="col-sm-6 themeBg">
                <div>
                <span class="text-600 text-110 text-blue align-middle">{{ucfirst($settingDetails ? $settingDetails->company_name:'')}}</span>
                </div>
                <div class="text-grey-m2">
                  <div class="my-1"> {{ucfirst($settingDetails ? $settingDetails->streat_name_1:'')}}, {{ucfirst($settingDetails ?$settingDetails->streat_name_2:'')}}, {{ucfirst($settingDetails ? $settingDetails->streat_name_3:'')}}, {{$settingDetails ? $settingDetails->place_code:''}}</div>
                  <div class="my-1"> {{ucfirst($settingDetails ? $settingDetails->place_name:'')}}, {{ucfirst($settingDetails ? $settingDetails->country:'')}}</div>
                  <div class="my-1">
                    <i class="fa fa-phone fa-flip-horizontal text-secondary"></i>
                    <b class="text-600">{{__('messages.phone')}}: {{$settingDetails ? $settingDetails->phone:''}}</b>
                  </div>
                  <div class="my-1"> {{__('messages.email')}}: {{$settingDetails ? $settingDetails->email:''}}</div>
                </div>
              </div>
              <div class="themeBg text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                <hr class="d-sm-none">
                <div class="text-grey-m2">
                <div>
                <span class="text-600 text-110 text-blue align-middle">{{ucfirst($settingDetails ? $settingDetails->company_name:'')}}</span>
                </div>
                <div class="text-grey-m2">
                  <div class="my-1"> {{strtoupper($prospact->cust_name)}}</div>
                  <div class="my-1"> {{strtoupper($prospact->company_name)}}</div>
                  <div class="my-1"> {{strtoupper($prospact->street_name)}}, {{strtoupper($prospact->post_code)}}</div>
                  <div class="my-1"> {{strtoupper($prospact->place_name)}}</div>
                  <div class="my-1"> Quotation No. #{{sprintf('%06d', $prospact->quotation->quotation_number)}}</div>
                  <div class="my-1"> Quotation Date : {{date('d-m-Y', strtotime($prospact->quotation->quotation_date))}}</div>
                </div>
                </div>
              </div>
            </div>
            <div class="mt-4">
              <div class="row text-600 text-white bgc-default-tp1 py-25">
                <div class="d-none d-sm-block col-1" style="text-transform: uppercase;">{{__('messages.Position')}}</div>
                <div class="col-9 col-sm-5" style="text-transform: uppercase;">{{__('messages.Article Description')}}</div>
                <div class="d-none d-sm-block col-4 col-sm-2" style="text-transform: uppercase;">{{__('messages.Price Per Article($)')}}</div>
                <div class="d-none d-sm-block col-sm-2" style="text-transform: uppercase;">{{__('messages.No. of Article')}}</div>
                <div class="col-2" style="text-transform: uppercase;">{{__('messages.Total Price($)')}}</div>
              </div>
              <div class="text-95 text-secondary-d3">
              @foreach($prospact->quotations as $index=>$quotation)
                <div class="row mb-2 mb-sm-0 py-25 @if($index%2!=0) bgc-default-l4 @endif ">
                  <div class="d-none d-sm-block col-1">{{$quotation->number_of_position}}</div>
                  <div class="col-9 col-sm-5">{{$quotation->article_description}}</div>
                  <div class="d-none d-sm-block col-2">{{$quotation->prise_per_article}}</div>
                  <div class="d-none d-sm-block col-2 text-95">{{$quotation->number_of_article}}</div>
                  <div class="col-2 text-secondary-d2">${{$quotation->price}}</div>
                </div>
                @endforeach
              </div>
              <div class="row border-b-2 brc-default-l2"></div>
              <div class="row">
              <div class="col-md-12" style="padding: 0px;">
                <hr style="margin-top: 0px;">
              </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0 themeBg"> {{$prospact->quotation->comments}}</div>
                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                  <div class="row my-2">
                    <div class="col-7 text-right"> {{__('messages.Subtotal')}}</div>
                    <div class="col-5">
                      <span class="text-120 text-secondary-d1">${{$quotation->sub_total}}</span>
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-7 text-right"> {{__('messages.Tax')}} ({{$settingDetails ? $settingDetails->ust_number:''}}%)</div>
                    <div class="col-5">
                      <span class="text-110 text-secondary-d1">${{$quotation->ust_number}}</span>
                    </div>
                  </div>
                  <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                    <div class="col-7 text-right"> <b>{{__('messages.Grand Total')}}</b></div>
                    <div class="col-5">
                      <span class="text-150 text-success-d3 opacity-2"><b>${{$quotation->grand_total}}</b></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center footer-content">
              <div class="row">
              <div class="col-md-12" style="padding: 0px;">
                <hr>
              </div>
              </div>
              {!!Auth::guard('admin')->user()->settings()->footer_text !!}
                <br/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style type="text/css">
      body {
        margin-top: 20px;
        color: #484b51;
      }
      .themeBg{
        background-color: #f3f8fa;
      }
      .text-secondary-d1 {
        /* color: #728299 !important; */
      }

      .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
      }

      .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
      }

      .brc-default-l1 {
        border-color: #dce9f0 !important;
      }

      .ml-n1,
      .mx-n1 {
        margin-left: -.25rem !important;
      }

      .mr-n1,
      .mx-n1 {
        margin-right: -.25rem !important;
      }

      .mb-4,
      .my-4 {
        margin-bottom: 1.5rem !important;
      }

      hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid #84b0ca;
      }

      .text-grey-m2 {
        /* color: #888a8d !important; */
      }

      .text-success-m2 {
        /* color: #86bd68 !important; */
      }

      .font-bolder,
      .text-600 {
        font-weight: 600 !important;
      }

      .text-110 {
        font-size: 110% !important;
      }

      .text-blue {
        color: #478fcc !important;
      }

      .pb-25,
      .py-25 {
        padding-bottom: .75rem !important;
      }

      .pt-25,
      .py-25 {
        padding-top: .75rem !important;
      }

      .bgc-default-tp1 {
        background-color: rgba(121, 169, 197, .92) !important;
      }

      .bgc-default-l4,
      .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
      }

      .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
      }

      .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
      }

      .w-2 {
        width: 1rem;
      }

      .text-120 {
        font-size: 120% !important;
      }

      .text-primary-m1 {
        color: #4087d4 !important;
      }

      .text-danger-m1 {
        color: #dd4949 !important;
      }

      .text-blue-m2 {
        color: #68a3d5 !important;
      }

      .text-150 {
        font-size: 150% !important;
      }

      .text-60 {
        font-size: 60% !important;
      }

      .text-grey-m1 {
        color: #7b7d81 !important;
      }

      .align-bottom {
        vertical-align: bottom !important;
      }
      @media screen {
  .footer-content {
    width: 100%;
  }
}
@media print {
  .container{
    min-width: 97% !important;
  }
  .footer-content {
    width: 88%;
    position: fixed;
    bottom: 0;
  }
  .page-header{
    display: none;
  }
  body {
  -webkit-print-color-adjust: exact !important;
}
}
    </style>
  </div>
</body>
</html>