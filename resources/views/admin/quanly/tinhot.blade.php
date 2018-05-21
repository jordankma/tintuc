@extends('admin.layout.index')
@section('content')
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chọn các tin hot để hiển thị
                        </h1>
                    </div>
                    <form action="admin/quanly/tinhot" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                		<div class="form-group">
                            <label>Tin 1</label>
                            <input class="form-control Tin1" name="Tin1" placeholder="Tìm tin tức ở vị trí 1" value="" />
                            <select id="Tin1" class="selectpicker" name="Tin1">
                                 <option value=""></option>
                            </select>
                            <button type="button" class="btn" id="TimTin1">Tìm</button>
                        </div>
                        <div class="form-group">
                            <label>Tin 2</label>
                            <input class="form-control" name="Tin2" placeholder="Tìm tin tức ở vị trí 2" value="" />
                        </div>
                        <div class="form-group">
                            <label>Tin 3</label>
                            <input class="form-control" name="Tin3" placeholder="Tìm tin tức ở vị trí 3" value="" />
                        </div>
                        <div class="form-group">
                            <label>Tin 4</label>
                            <input class="form-control" name="Tin4" placeholder="Tìm tin tức ở vị trí 4" value="" />
                        </div>
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                	</form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){    
            $("#TheLoai").change(function(){  
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $("#LoaiTin").html(data);
                });
            });
            $('#TimTin1').click(function(){
                var TuKhoaTin1 = $('.Tin1').val();
                $.get("admin/ajax/tinhot1/"+TuKhoaTin1,function(data){
                    $("#Tin1").html(data);
                });
            });
        });
    </script>
@endsection