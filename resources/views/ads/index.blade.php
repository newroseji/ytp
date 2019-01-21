@extends('layouts.blog_tpl')
@section('breadcrumbs', Breadcrumbs::render('ads.index'))
@section('content')
<div class="container">
    <div class="justify-content-center">
        <!-- <div class="col-md-12"> -->
            <div class="card">

                <div class="card-header">

                    <div class="d-flex bd-highlight mb-3">
                        <div class="mr-auto p-2 bd-highlight"
                        data-toggle="collapse" 
                        data-target="#collapseAds" 
                        aria-expanded="false" 
                        aria-controls="collapseAds"
                        style="cursor:pointer"
                        ><h5>All Ads</h5></div>

                        <div class="p-2 bd-highlight">
                            <span class="btn btn-sm btn-warning">displaying
                                <span class="badge badge-pill badge-success">{{ $ads->count() }}</span>
                                out of 
                                <span class="badge badge-pill badge-primary">{{ $ads->total() }}</span>
                            </span>
                        </div>

                        <div class="p-2 bd-highlight">

                        <!-- Button trigger add new Ad modal 
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adModal">
                          Add new Ad
                      </button>
                        -->
                        <a href="{{ route('ads.create')}}" class="btn btn-primary btn-sm" title="Create new Ad">Add new Ad</a>

                        
                  </div>
              </div>


          </div>

          <div class="card-body" id="tag_container">


            @if($ads->count())
            @include('ads.__pagination')



            @else
            <p><span class="badge badge-danger">No Ads found</span></p>
            @endif



        </div>


    </div>
    <!-- </div> -->
</div>
</div>
@endsection('content')

@section('ext_js')

<!-- For BS Modal -- START -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
<!-- For BS Modal -- END -->


@endsection('ext_js')

@section('bs_modal')
<!-- Modal -->
<div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="adModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adModalLabel">Add New Ad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    @include('ads.__create')
</div>

</div>
</div>
</div>
@endsection('bs-modal')
