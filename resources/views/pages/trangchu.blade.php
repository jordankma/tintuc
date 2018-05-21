@extends('layout.index')
@section('content')
<style type="text/css">
	.top-news-left-top-bottom .top-news-left-top-bottom-img img{
		width: 274px; 
        height: 159px; 
	}
	.top-news-left-top-banner-img img{
		width: 562px;
		height: 303px;
	}
	.top-news-left-top-5tin-list-left img{
		width: 82px;
		height: 51px;
		
	}
	.top-news-left-top-5tin li{
		padding-top:11px;	
	}
	.top-news-left-top-5tin li:first-child{
		padding-top: 0px;
	}
</style>
<!-- Page Content -->
    <div class="container">

    	@include('layout.slide')

        <div class="space20"></div>

		<!-- top new -->
		<section id="top-news">
			<div class="container">
				<div class="row">
					<!-- top news right -->
					<?php
						$data_tophome_noibat = $tintuc->where('NoiBatHome',1)->sortByDesc('updated_at')->take(4);
		                $data_tophome_thuong = $tintuc->where('NoiBatHome',0)->sortByDesc('updated_at')->take(5);
		                $arr_idTin_topHome = array();
		                $i = 0;
		                foreach ($data_tophome_noibat as $value) {
		                	$arr_idTin_topHome[$i] = $value->id;
		                	$i++;
		                }
		                foreach ($data_tophome_thuong as $value) {
		                	$arr_idTin_topHome[$i] = $value->id;
		                	$i++;
		                }
		                $tin1 = $data_tophome_noibat->shift();		                
					?>
					<div class="top-news-right col-md-9">
						<div class="top-news-left-top">
							<div class="row">
								<div class="col-md-8 col-sm-8 top-news-left-top-banner">
									<div class="top-news-left-top-banner-img">
										<a href="tintuc/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html"><img src="upload/tintuc/{{$tin1->Hinh}}" alt="" class="img-responsive"></a>
									</div>
									<div class="top-news-left-top-banner-tit">
										<a href="tintuc/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">{{$tin1->TieuDe}}</a>
									</div>		
								</div>
								<div class="col-md-4 col-sm-4 top-news-left-top-5tin">
									<ul class="list-unstyled ">
										@foreach ( $data_tophome_thuong as $tinMoi)
										<li>
											<div class="row">
												<div class="top-news-left-top-5tin-list-left col-md-4 col-xs-4">
													<a href="tintuc/{{$tinMoi->id}}/{{$tinMoi->TieuDeKhongDau}}.html"><img src="upload/tintuc/{{$tinMoi->Hinh}}" alt="" class="img-responsive"></a>
												</div>
												<div class="top-news-left-top-5tin-list-body col-md-8 col-xs-8">
													<a href="tintuc/{{$tinMoi->id}}/{{$tinMoi->TieuDeKhongDau}}.html">{{$tinMoi->TieuDe}}</a>		
												</div>													
											</div>		
										</li>
										@endforeach
									</ul>		
								</div> <!-- end top-news-left-top-5tin -->
							</div>	<!-- end row top-news-left-top -->
						</div> <!-- end top-news-left-top -->
						<div class="top-news-left-top-bottom">
							<div class="row">
								<ul class="list-unstyled">
									@foreach ($data_tophome_noibat->all() as $tinThuong)
									<li class="col-md-4 col-sm-4">
										<div class="top-news-left-top-bottom-img">
											<a href="tintuc/{{$tinThuong->id}}/{{$tinThuong->TieuDeKhongDau}}.html"><img src="upload/tintuc/{{$tinThuong->Hinh}}" alt="" class="img-responsive"></a>	
										</div>
										<div class="top-news-left-top-bottom-dec">
											<a href="tintuc/{{$tinThuong->id}}/{{$tinThuong->TieuDeKhongDau}}.html">{{$tinThuong->TieuDe}}</a>
											<p>{{$tinThuong->TomTat}}</p>
										</div>	
									</li>
									@endforeach
								</ul>
							</div>		
						</div> <!-- end top-news-left-top-bottom -->	
					</div>		<!-- end top news right -->	
					<div class="top-news-right col-md-3">
						<div class="adv-2">
							<a href=""><img src="image/noibat_banner2.jpg" alt="" class="img-responsive"></a>
						</div>
						<div class="adv-3">
							<a href=""><img src="image/noibat_banner3.png" alt="" class="img-responsive"></a>
						</div>
					</div> <!-- end top news right -->
				</div>
			</div>
		</section> <!-- end section top-news -->
        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>
	            	<div class="panel-body">
	            		@foreach ($theloai as $tl)
	            		@if( count($tl->loaitin)>0)
	            		<!-- item -->
					    <div class="row-item row">
		                	<h3>
		                		<a href="category.html">{{$tl->Ten}}</a> | 
		                		@foreach ($tl ->loaitin as $lt)	
		                			<small>
		                				<a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/
		                			</small>
		                		@endforeach
		                	</h3>
		                	<?php 
		                		$data = $tl->tintuc->where('NoiBat',1)->sortBy('create_at')->take(5);
		                		$tin1 = $data->shift();
		                	?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
			                        </a>
			                    </div>
			                    <div class="col-md-7">
			                        <h3>{{$tin1['TieuDe']}}</h3>
			                        <p>{{$tin1['TomTat']}}</p>
			                        <a class="btn btn-primary" href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
		                	</div>

							<div class="col-md-4">
								@foreach ($data->all() as $tin)
								<a href="tintuc/{{$tin['id']}}/{{$tin['TieuDeKhongDau']}}.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{$tin['TieuDe']}}
									</h4>
								</a>
								@endforeach
							</div>
							
							<div class="break"></div>
		                </div>
		                <!-- end item -->
		                @endif
		                @endforeach	            
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection