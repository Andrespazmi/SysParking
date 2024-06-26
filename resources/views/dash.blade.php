 @extends('layouts.template')
 @section('content')
  <div id="content" class="main-content">
            


 <div class="row mt-5">
 	<div class="col-lg-8">
 	<div class="layout-px">
            	 <div class="widget-content-area">
                            <div class="widget-one">
 	{!! $chart->container() !!}

 	<script src="{{ $chart->cdn() }}"></script>

 	{{ $chart->script() }}
 	</div>
 	</div>
</div>
</div>

 	<div class="col-lg-4">
 		<div class="layout-px">
            	 <div class="widget-content-area">
                            <div class="widget-one">
 		{!! $chart2->container() !!}

 	<script src="{{ $chart->cdn() }}"></script>

 	{{ $chart2->script() }}
 	</div>
 	</div>
</div>
</div>

 	<div class="col-lg-12 mt-2">
 			<div class="layout-px">
            	 <div class="widget-content-area">
                            <div class="widget-one">
 	{!! $chart3->container() !!}

 	<script src="{{ $chart3->cdn() }}"></script>

 	{{ $chart3->script() }}
 	</div>
 </div>  	
</div>
</div>


</div>
</div>
 @endsection