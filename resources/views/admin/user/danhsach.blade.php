@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    {{-- form search --}}
                            <div class="row" style="margin-left: 10px;margin-right: 10px; border: 2px solid red">
                                <form class="form-inline" method="POST" action="{{route('admin.user.filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group col-md-12">
                                        <label class="">Nhập tên người dùng : </label>
                                        <input  type="text" class="form-control " name="name" placeholder="Nhập tên người dùng ">    
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Nhập tên tài khoản : </label>
                                        <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng nhập">    
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Chọn khoảng thời gian : </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Từ</label>
                                                <input type="date" class="form-control" name="startDate" >    
                                            </div> 
                                            <div class="col-md-6">
                                                <label>Đến</label>
                                                <input type="date" class="form-control" name="endDate" >    
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Ngày đăng ký : </label>
                                        <input type="date" class="form-control" name="datecreate" >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Lần đăng nhập cuối : </label>
                                        <input type="date" class="form-control" name="lastlogin" >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="checkbox">
                                          <label><input type="checkbox" value="ok" name="blockuser">Tài khoản bị khóa</label>
                                        </div>
                                        <div class="checkbox">
                                          <label><input type="checkbox" value="ok" name="longactive" >Không hoạt động trong 90 ngày</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-default">Tìm kiếm</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                </form>
                            </div>
                            {{-- end form search --}}
                    <!-- /.col-lg-12 -->
                    @if (session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}    
                            </div>   
                        @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{$u->id}}</td>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if($u->quyen==1)
                                        {{"admin"}}
                                    @else
                                        {{"Người dùng"}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoa/{{$u->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$u->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection