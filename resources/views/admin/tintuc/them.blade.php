 @extends('admin.layout.index')
 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if (count($errors)>0) 
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $loi)
                                    {{$loi}}<br>
                                @endforeach   
                            </div>
                        @endif
                        @if (session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}    
                            </div>   
                        @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach ($theloai as $tl)
                                        <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                        $idTheLoai = $tl->id;
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach ($loaitin as $lt)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach     
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                            </div>  
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name= "TomTat" id="demo" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio">Có
                                </label>
                            </div>
                            {{-- <div class="form-group" id="ChonCheDo">
                                <label>Chọn cách hiển thị tin hot </label>
                                <label class="radio-inline">
                                    <input name="ChonCheDo"  value="0"  type="radio">Auto
                                </label>
                                <label class="radio-inline">
                                    <input name="ChonCheDo"  value="1" type="radio">Custom
                                </label>
                            </div> --}}
                            <div class="form-group auto" style="display: none">
                                <label>Nổi bật Home</label>
                                <label class="radio-inline">
                                    <input name="NoiBatHome" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBatHome" value="1" type="radio">Có
                                </label>
                            </div>
                            {{-- <div class="form-group custom" style="display: none">
                                <label>Nổi bật home custom</label>
                                <input type="text" name="idTinNoiBat"  >
                            </div> --}}
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        //alert('test');
        $(document).ready(function(){    
            $("#TheLoai").change(function(){  
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            });
            // $('#ChonCheDo input:radio').click(function() {
            //     if ($(this).val() === '0') {
            //         if ($('.custom').attr('style') == 'display:block'){
            //             $('.custom').attr('style','display:none');    
            //         }
            //         $('.auto').attr('style','display:block');
            //     } else if ($(this).val() === '1') {
            //         if ($('.auto').attr('style') == 'display:block'){
            //             $('.auto').attr('style','display:none');    
            //         }
            //         $('.custom').attr('style','display:block');
            //     } 
            //   });
        });
    </script>
@endsection